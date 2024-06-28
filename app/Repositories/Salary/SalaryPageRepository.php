<?php

namespace App\Repositories\Salary;

use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SalaryResource;

class SalaryPageRepository
{
    function data() {
        $data = [];
        $currentSalary = Salary::when(Auth::user()->role_id !== 1, function ($query) {
            return $query->where('hr_id', Auth::user()->staff->id)->where('hr_agree', 0);
        })->when(Auth::user()->role_id === 1, function ($query) {
            return $query->whereNUll('disbursement_date');
        })
        ->orderBy('full_salary', 'DESC')
        ->With('hr.user.role')
        ->get();
        $data['current']['data'] = SalaryResource::collection($currentSalary);
        // dd($data);
        $data['current']['info'] = $this->info();

        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $oldSalary = Salary::when(Auth::user()->role_id !== 1, function ($query) {
            return $query->where('hr_id', Auth::user()->staff->id);
        })
        ->whereDate('disbursement_date', '>=', $threeMonthsAgo)
        ->whereDate('disbursement_date', '<=', Carbon::now())
        ->orderBy('created_at', 'DESC')
        ->With('hr.user.role')
        ->get();
        $data['old']['data'] = SalaryResource::collection($oldSalary);
        $data['old']['info'] = count($data['old']['data']) ?$this->oldInfo($data['old']['data']) :[];
        // dd($data);
        return $data;
    }

    function info() {
        $salary = Salary::latest()->first();
        // $vacancy = Vacancy::where('status_id', 3)
        //         ->where('updated_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())
        //         ->count();

        // $deposit = VacancyDeposit::where(function($query) {
        //         $query->where('must_be_enrolled_employer', '<', DB::raw('employer_initial_amount'))
        //                 ->orWhere('must_be_enrolled_candidate', '<', DB::raw('candidate_initial_amount'));
        //     })
        //     ->where('updated_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())
        //     ->count();
        // dd(Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString());
        $enrollment_total = $salary?Enrollment::where('agree', 1)
            ->where('created_at', '>=', $salary->created_at)
            ->sum('money'):0;

        return ['enrollment_total' => $enrollment_total];
    }

    function oldInfo($data) {
        $firstElement = collect($data)->first();
        $lastElement = collect($data)->last();
        // dd($firstElement['disbursement_date'], $lastElement['disbursement_date']);
        $enrollment_total = Enrollment::where('agree', 1)
            ->whereDate('created_at', '>=', Carbon::parse($lastElement['created_at'])->startOfDay()->toDateTimeString())
            ->whereDate('created_at', '<=', Carbon::parse($firstElement['disbursement_date'])->startOfDay()->toDateTimeString())
            ->sum('money');

        return ['enrollment_total' => $enrollment_total];
    }
}

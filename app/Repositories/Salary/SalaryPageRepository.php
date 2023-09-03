<?php

namespace App\Repositories\Salary;

use App\Models\Enrollment;
use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\VacancyDeposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalaryPageRepository
{
    function data() {
        $data = [];
        $data['current']['data'] = Salary::when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->hr->id)->where('hr_agree', 0);
            })->when(Auth::user()->role_id === 1, function ($query) {
                return $query->whereNUll('disbursement_date');
            })
            // ->whereNUll('disbursement_date')

            ->orderBy('full_salary', 'DESC')
            ->With('hr.user')
            ->get()->toArray();
        // dd($data);
        $data['current']['info'] = $this->info();
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
        $enrollment_total = Enrollment::where('agree', 1)
            ->whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())
            ->sum('money');

        return ['enrollment_total' => $enrollment_total];
    }
}

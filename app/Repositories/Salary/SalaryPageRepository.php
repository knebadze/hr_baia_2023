<?php

namespace App\Repositories\Salary;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SalaryResource;

class SalaryPageRepository
{
    function data($childView) {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $data = [];
        $currentSalary = Salary::when($auth->role_id !== 1, function ($query) use($auth) {
            return $query->where('staff_id', $auth->id)->where('staff_agree', 0);
        })->when($auth->role_id === 1, function ($query) {
            return $query->whereNUll('disbursement_date');
        })->when($childView, function ($query) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $query->whereIn('staff_id', $ids);
        })
        ->orderBy('full_salary', 'DESC')
        ->get();
        $data['current']['data'] = SalaryResource::collection($currentSalary);
        $data['current']['info'] = $this->info();

        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $oldSalary = Salary::when($auth->role_id !== 1, function ($query) use($auth) {
            return $query->where('staff_id', $auth->id);
        })
        ->whereDate('disbursement_date', '>=', $threeMonthsAgo)
        ->whereDate('disbursement_date', '<=', Carbon::now())
        ->when($childView, function ($query) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $query->whereIn('staff_id', $ids);
        })
        ->orderBy('created_at', 'DESC')
        ->get();
        $data['old']['data'] = SalaryResource::collection($oldSalary);
        $data['old']['info'] = count($data['old']['data']) ?$this->oldInfo($data['old']['data']) :[];
        return $data;
    }
    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }
    function info() {
        $salary = Salary::latest()->first();
        $enrollment_total = $salary?Enrollment::where('agree', 1)
            ->where('created_at', '>=', $salary->created_at)
            ->sum('money'):0;

        return ['enrollment_total' => $enrollment_total];
    }

    function oldInfo($data) {
        $firstElement = collect($data)->first();
        $lastElement = collect($data)->last();
        $enrollment_total = Enrollment::where('agree', 1)
            ->whereDate('created_at', '>=', Carbon::parse($lastElement['created_at'])->startOfDay()->toDateTimeString())
            ->whereDate('created_at', '<=', Carbon::parse($firstElement['disbursement_date'])->startOfDay()->toDateTimeString())
            ->sum('money');

        return ['enrollment_total' => $enrollment_total];
    }
}

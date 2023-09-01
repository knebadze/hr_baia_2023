<?php

namespace App\Repositories\Salary;

use App\Models\Salary;
use Illuminate\Support\Facades\Auth;

class SalaryPageRepository
{
    function data() {
        $data = [];
        $data['current'] = Salary::when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->hr->id);
            })
            ->where('hr_agree', 0)
            ->orderBy('full_salary', 'DESC')
            ->With('hr.user')
            ->get()->toArray();
        // dd($data);
        return $data;
    }
}

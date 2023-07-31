<?php

namespace App\Filters\Vacancy\Admin;

use Illuminate\Support\Facades\Auth;

class VacancyHrFilter
{

    function __invoke($query, $request)
    {
        $hr_id = Auth::user()->hr->id;
        return $query->where('hr_id', $hr_id);

    }
}

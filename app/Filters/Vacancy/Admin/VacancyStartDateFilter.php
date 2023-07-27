<?php

namespace App\Filters\Vacancy\Admin;

use Carbon\Carbon;

class VacancyStartDateFilter
{
    function __invoke($query, $request)
    {
        
        return $query->where('start_date', '>=', Carbon::parse($request[0])->toDateString())->where('start_date', '<=', Carbon::parse($request[1])->toDateString());

    }
}

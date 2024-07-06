<?php

namespace App\Filters\Vacancy\Admin;

use Carbon\Carbon;

class VacancyInterviewDateFilter
{
    function __invoke($query, $request)
    {
        return $query->where('interview_date', '>=', Carbon::parse($request[0])->toDateTimeString())->where('interview_date', '<=', Carbon::parse($request[1])->toDateTimeString());

    }
}

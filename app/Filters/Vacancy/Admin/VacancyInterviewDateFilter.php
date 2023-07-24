<?php

namespace App\Filters\Vacancy\Admin;

use Carbon\Carbon;

class vacancyInterviewDateFilter
{
    function __invoke($query, $request)
    {
        // dd(Carbon::parse($request[0])->toDateString());
        return $query->where('interview_date', '>=', Carbon::parse($request[0])->toDateTimeString())->where('interview_date', '<=', Carbon::parse($request[1])->toDateTimeString());

    }
}

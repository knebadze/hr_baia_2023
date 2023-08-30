<?php

namespace App\Filters\Enrollment;

use Carbon\Carbon;


class EnrollmentDateFilter
{
    function __invoke($query, $request)
    {
        return $query->whereDate('enrollments.created_at', '>=', Carbon::parse($request[0])->startOfDay()->toDateTimeString())
                    ->whereDate('enrollments.created_at', '<=', Carbon::parse($request[1])->endOfDay()->toDateTimeString());

    }
}

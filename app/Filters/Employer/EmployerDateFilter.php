<?php

namespace App\Filters\Employer;

use Carbon\Carbon;


class EmployerDateFilter
{
    function __invoke($query, $request)
    {
        return $query->whereDate('created_at', '>=', Carbon::parse($request[0])->startOfDay()->toDateTimeString())
                    ->whereDate('created_at', '<=', Carbon::parse($request[1])->endOfDay()->toDateTimeString());

    }
}

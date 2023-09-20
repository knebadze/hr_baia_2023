<?php

namespace App\Filters\Salary;

use Carbon\Carbon;


class SalaryDateFilter
{
    function __invoke($query, $request)
    {
        // dd($request);
        return $query->whereDate('disbursement_date', '>=', Carbon::parse($request[0])->startOfDay()->toDateTimeString())
                    ->whereDate('disbursement_date', '<=', Carbon::parse($request[1])->endOfDay()->toDateTimeString());

    }
}

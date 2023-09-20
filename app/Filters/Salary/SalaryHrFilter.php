<?php

namespace App\Filters\Salary;


class SalaryHrFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('hr_id', $ids);

    }
}

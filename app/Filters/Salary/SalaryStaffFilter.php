<?php

namespace App\Filters\Salary;


class SalaryStaffFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('staff_id', $ids);

    }
}

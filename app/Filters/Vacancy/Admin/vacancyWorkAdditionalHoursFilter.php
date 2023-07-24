<?php

namespace App\Filters\Vacancy\Admin;

class vacancyWorkAdditionalHoursFilter
{
    function __invoke($query, $request)
    {
        return $query->where('work_additional_hours', $request);

    }
}

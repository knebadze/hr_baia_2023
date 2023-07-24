<?php

namespace App\Filters\Vacancy\Admin;

class vacancyStayNightFilter
{
    function __invoke($query, $request)
    {
        return $query->where('stay_night', $request);

    }
}

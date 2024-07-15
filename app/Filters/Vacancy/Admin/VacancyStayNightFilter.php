<?php

namespace App\Filters\Vacancy\Admin;

class VacancyStayNightFilter
{
    function __invoke($query, $request)
    {
        return $query->where('stay_night', $request);

    }
}

<?php

namespace App\Filters\Vacancy\Admin;

class VacancyGoVacationFilter
{
    function __invoke($query, $request)
    {
        return $query->where('go_vacation', $request);

    }
}

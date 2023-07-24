<?php

namespace App\Filters\Vacancy\Admin;

class vacancyGoVacationFilter
{
    function __invoke($query, $request)
    {
        return $query->where('go_vacation', $request);

    }
}

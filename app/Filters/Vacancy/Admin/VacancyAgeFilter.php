<?php

namespace App\Filters\Vacancy\Admin;

class VacancyAgeFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('demand', function ($query) use ( $request ) {
            return $query->where('min_age', '>=', $request[0])->where('max_age', '<=', $request[1]);
        });

    }
}

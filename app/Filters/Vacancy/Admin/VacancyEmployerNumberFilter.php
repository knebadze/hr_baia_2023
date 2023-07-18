<?php

namespace App\Filters\Vacancy\Admin;

class VacancyEmployerNumberFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('employer', function ($query) use ( $request ) {
            return $query->where('number', $request);
        });

    }
}

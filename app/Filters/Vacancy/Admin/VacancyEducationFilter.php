<?php

namespace App\Filters\Vacancy\Admin;

class VacancyEducationFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('demand', function ($query) use ( $ids ) {
            return $query->whereIn('education_id', $ids);
        });

    }
}

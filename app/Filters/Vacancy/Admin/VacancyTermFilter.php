<?php

namespace App\Filters\Vacancy\Admin;

class VacancyTermFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('term', function ($query) use ( $ids ) {
            return $query->whereIn('term_id', $ids);
        });

    }
}

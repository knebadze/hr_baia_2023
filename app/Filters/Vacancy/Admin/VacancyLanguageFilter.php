<?php

namespace App\Filters\Vacancy\Admin;

class VacancyLanguageFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('demand', function ($query) use ( $ids ) {
            return $query->whereIn('language_id', $ids);
        });

    }
}

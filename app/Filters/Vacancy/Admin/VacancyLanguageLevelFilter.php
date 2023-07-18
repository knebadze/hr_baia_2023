<?php

namespace App\Filters\Vacancy\Admin;

class VacancyLanguageLevelFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('demand', function ($query) use ( $ids ) {
            return $query->whereIn('language_level_id', $ids);
        });

    }
}

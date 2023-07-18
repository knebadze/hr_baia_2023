<?php

namespace App\Filters\Vacancy\Admin;

class VacancyCategoryFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('category', function ($query) use ( $ids ) {
            return $query->whereIn('category_id', $ids);
        });

    }
}

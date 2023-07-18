<?php

namespace App\Filters\Vacancy\Admin;

class VacancyStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('status', function ($query) use ( $ids ) {
            return $query->whereIn('status_id', $ids);
        });

    }
}

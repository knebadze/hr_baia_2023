<?php

namespace App\Filters\Vacancy\Admin;

class VacancyStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        // dd($ids);
        return $query->whereIn('status_id', $ids);

    }
}

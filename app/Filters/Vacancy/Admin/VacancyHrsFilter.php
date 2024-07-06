<?php

namespace App\Filters\Vacancy\Admin;

use Illuminate\Support\Facades\Auth;

class VacancyHrsFilter
{

    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('hr_id', $ids);

    }
}

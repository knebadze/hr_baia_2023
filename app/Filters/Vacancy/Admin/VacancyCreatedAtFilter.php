<?php

namespace App\Filters\Vacancy\Admin;

use Carbon\Carbon;

class VacancyCreatedAtFilter
{
    function __invoke($query, $request)
    {
        return $query->whereDate('created_at', '>=', Carbon::parse($request[0])->toDateString())->whereDate('created_at', '<=', Carbon::parse($request[1])->toDateString());

    }
}

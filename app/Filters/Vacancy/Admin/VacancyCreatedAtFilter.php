<?php

namespace App\Filters\Vacancy\Admin;

use Carbon\Carbon;

class vacancyCreatedAtFilter
{
    function __invoke($query, $request)
    {
        // dd(Carbon::parse($request[0])->toDateString());
        return $query->whereDate('created_at', '>=', Carbon::parse($request[0])->toDateString())->whereDate('created_at', '<=', Carbon::parse($request[1])->toDateString());

    }
}

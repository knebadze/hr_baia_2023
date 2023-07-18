<?php

namespace App\Filters\Vacancy\Admin;

class vacancyCodeFilter
{
    function __invoke($query, $request)
    {
        return $query->where('code', $request);

    }
}

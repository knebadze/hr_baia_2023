<?php

namespace App\Filters\Employer;


class EmployerNameFilter
{
    function __invoke($query, $request)
    {
        return $query->where('name_ka', 'LIKE', $request.'%');
    }
}

<?php

namespace App\Filters\Employer;


class EmployerEmailFilter
{
    function __invoke($query, $request)
    {
        return $query->where('email', 'LIKE', $request.'%');
    }
}

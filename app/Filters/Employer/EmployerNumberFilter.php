<?php

namespace App\Filters\Employer;


class EmployerNumberFilter
{
    function __invoke($query, $request)
    {
        return $query->where('number', $request);
    }
}

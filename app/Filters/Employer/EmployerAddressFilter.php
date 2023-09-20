<?php

namespace App\Filters\Employer;


class EmployerAddressFilter
{
    function __invoke($query, $request)
    {
        return $query->where('address_ka', 'LIKE', $request.'%');
    }
}

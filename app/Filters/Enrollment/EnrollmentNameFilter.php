<?php

namespace App\Filters\Enrollment;


class EnrollmentNameFilter
{
    function __invoke($query, $request)
    {
        return $query->where('name', 'LIKE', $request.'%');
    }
}

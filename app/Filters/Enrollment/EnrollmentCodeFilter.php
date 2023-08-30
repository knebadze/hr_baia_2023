<?php

namespace App\Filters\Enrollment;


class EnrollmentCodeFilter
{
    function __invoke($query, $request)
    {
        return $query->where('code', $request);

    }
}

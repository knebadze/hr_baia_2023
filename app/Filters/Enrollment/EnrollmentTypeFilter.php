<?php

namespace App\Filters\Enrollment;


class EnrollmentTypeFilter
{
    function __invoke($query, $request)
    {
        return $query->where('type', $request['id']);

    }
}

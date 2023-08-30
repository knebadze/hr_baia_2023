<?php

namespace App\Filters\Enrollment;


class EnrollmentEnrollmentTypeFilter
{
    function __invoke($query, $request)
    {
        return $query->where('enrollment_type', $request['id']);

    }
}

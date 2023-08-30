<?php

namespace App\Filters\Enrollment;


class EnrollmentStatusFilter
{
    function __invoke($query, $request)
    {
        return $query->where('agree', $request['id']);

    }
}

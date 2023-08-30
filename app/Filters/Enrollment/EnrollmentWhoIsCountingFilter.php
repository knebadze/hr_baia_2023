<?php

namespace App\Filters\Enrollment;


class EnrollmentWhoIsCountingFilter
{
    function __invoke($query, $request)
    {
        return $query->where('who_is_counting', $request['id']);

    }
}

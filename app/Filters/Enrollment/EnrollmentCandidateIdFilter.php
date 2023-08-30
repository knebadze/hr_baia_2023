<?php

namespace App\Filters\Enrollment;


class EnrollmentCandidateIdFilter
{
    function __invoke($query, $request)
    {
        return $query->where('candidate_id', $request);

    }
}

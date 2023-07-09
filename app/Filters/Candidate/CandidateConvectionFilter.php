<?php

namespace App\Filters\Candidate;

class CandidateConvectionFilter
{
    function __invoke($query, $request)
    {
        return $query->where('convection', $request);
    }
}

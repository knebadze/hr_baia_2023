<?php

namespace App\Filters\Candidate;

class CandidateIdFilter
{
    function __invoke($query, $request)
    {
        return $query->where('id', $request);
    }
}

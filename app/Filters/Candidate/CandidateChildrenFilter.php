<?php

namespace App\Filters\Candidate;

class CandidateChildrenFilter
{
    function __invoke($query, $request)
    {
        return $query->where('children', $request);
    }
}

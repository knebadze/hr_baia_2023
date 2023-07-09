<?php

namespace App\Filters\Candidate;

class CandidateWorkAbroadFilter
{
    function __invoke($query, $request)
    {
        return $query->where('smoke', $request);
    }
}

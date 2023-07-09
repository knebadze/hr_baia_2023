<?php

namespace App\Filters\Candidate;

class CandidateSmokeFilter
{
    function __invoke($query, $request)
    {
        return $query->where('smoke', $request);
    }
}

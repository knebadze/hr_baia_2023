<?php

namespace App\Filters\Candidate;

class CandidateWeightFilter
{
    function __invoke($query, $request)
    {
        return $query->whereBetween('weight', [$request[0], $request[1]]);
    }
}

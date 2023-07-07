<?php

namespace App\Filters\Candidate;

class CandidateHeightFilter
{
    function __invoke($query, $request)
    {
        return $query->whereBetween('height', [$request[0], $request[1]]);
    }
}

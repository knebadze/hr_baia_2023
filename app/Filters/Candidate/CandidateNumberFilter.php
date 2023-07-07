<?php

namespace App\Filters\Candidate;

class CandidateNumberFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('number', $request);
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateStayNightFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('getWorkInformation', function ($query) use ( $request ) {
            return $query->where('stay_night', $request);
        });
    }
}

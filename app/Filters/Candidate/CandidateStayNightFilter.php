<?php

namespace App\Filters\Candidate;

class CandidateStayNightFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->where('stay_night', $request);
        });
    }
}

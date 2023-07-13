<?php

namespace App\Filters\Candidate;

class CandidateHasRecommendationFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('getRecommendation', function ($query) use ( $request ) {
            return $query->where('recommendation', 1);
        });
    }
}

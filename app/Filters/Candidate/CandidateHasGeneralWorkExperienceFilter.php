<?php

namespace App\Filters\Candidate;

class CandidateHasGeneralWorkExperienceFilter
{
    function __invoke($query, $request)
    {
        
        $query->whereHas('getGeneralWorkExperience', function ($query) use ( $request ) {
            return $query->where('experience', 1);
        });
    }
}

<?php

namespace App\Filters\Candidate;

class CandidateHasFamilyWorkExperienceFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('familyWorkExperience', function ($query) use ( $request ) {
            return $query->where('experience', 1);
        });
    }
}

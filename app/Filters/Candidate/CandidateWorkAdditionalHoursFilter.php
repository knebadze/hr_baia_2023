<?php

namespace App\Filters\Candidate;

class CandidateWorkAdditionalHoursFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->where('work_additional_hours', $request);
        });
    }
}

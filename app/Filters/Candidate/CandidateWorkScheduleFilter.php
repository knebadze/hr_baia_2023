<?php

namespace App\Filters\Candidate;

class CandidateWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->where('category_id', $request['id']);
        });

    }
}

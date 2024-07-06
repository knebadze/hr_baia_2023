<?php

namespace App\Filters\Candidate;

class CandidateGoVacationFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('getWorkInformation', function ($query) use ( $request ) {
            return $query->where('go_vacation', $request);
        });
    }
}

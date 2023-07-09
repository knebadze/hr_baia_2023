<?php

namespace App\Filters\Candidate;

class CandidateGoVacationFilter
{
    function __invoke($query, $request)
    {
        // dd($request);
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->where('go_vacation', $request);
        });
    }
}

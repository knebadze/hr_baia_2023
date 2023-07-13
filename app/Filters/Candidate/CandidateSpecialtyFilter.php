<?php

namespace App\Filters\Candidate;

class CandidateSpecialtyFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();

        $query->whereHas('specialty', function ($query) use ( $ids ) {
            return $query->whereIn('specialty_id', $ids );
        });

    }
}

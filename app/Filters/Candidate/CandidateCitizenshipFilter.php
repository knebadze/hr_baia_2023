<?php

namespace App\Filters\Candidate;

class CandidateCitizenshipFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('citizenship', function ($query) use ( $ids ) {
            return $query->whereIn('citizenship_id', $ids );
        });

    }
}

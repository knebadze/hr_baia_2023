<?php

namespace App\Filters\Candidate;

class CandidateProfessionFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('professions', function ($query) use ( $ids ) {
            return $query->whereIn('profession_id', $ids );
        });

    }
}

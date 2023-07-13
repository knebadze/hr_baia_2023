<?php

namespace App\Filters\Candidate;

class CandidateReligionFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('religion_id', $ids );

    }
}

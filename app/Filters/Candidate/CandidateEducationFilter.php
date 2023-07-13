<?php

namespace App\Filters\Candidate;

class CandidateEducationFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('education_id', $ids );

    }
}

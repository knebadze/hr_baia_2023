<?php

namespace App\Filters\Candidate;

class CandidateNationalityFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('nationality_id', $ids );

    }
}

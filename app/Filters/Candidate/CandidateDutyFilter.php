<?php

namespace App\Filters\Candidate;

class CandidateDutyFilter
{
    function __invoke($query, $request)
    {
        // $ids = collect($request)->pluck('id')->toArray();

        // return $query->whereIn('status_id', $ids);

    }
}

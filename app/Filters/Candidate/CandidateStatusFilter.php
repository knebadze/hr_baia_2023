<?php

namespace App\Filters\Candidate;

class CandidateStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('status_id', $ids);

    }
}

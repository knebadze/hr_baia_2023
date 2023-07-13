<?php

namespace App\Filters\Candidate;

class CandidateMaritalStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('maritalStatus', function ($query) use ( $ids ) {
            return $query->whereIn('marital_status_id', $ids );
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateMaritalStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('maritalStatus', function ($query) use ( $ids ) {
            return $query->whereIn('marital_status_id', $ids );
        });

    }
}

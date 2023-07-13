<?php

namespace App\Filters\Candidate;

class CandidateAllergyFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('allergy', function ($query) use ( $ids ) {
            return $query->whereIn('allergy_id', $ids );
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateAllergyFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('allergy', function ($query) use ( $ids ) {
            return $query->whereIn('allergy_id', $ids );
        });

    }
}

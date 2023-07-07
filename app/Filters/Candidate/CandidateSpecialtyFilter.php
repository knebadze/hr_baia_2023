<?php

namespace App\Filters\Candidate;

class CandidateSpecialtyFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }

        $query->whereHas('specialty', function ($query) use ( $ids ) {
            return $query->whereIn('specialty_id', $ids );
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateProfessionFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('profession', function ($query) use ( $ids ) {
            return $query->whereIn('profession_id', $ids );
        });

    }
}

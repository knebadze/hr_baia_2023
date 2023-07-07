<?php

namespace App\Filters\Candidate;

class CandidateCitizenshipFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('citizenship', function ($query) use ( $ids ) {
            return $query->whereIn('citizenship_id', $ids );
        });

    }
}

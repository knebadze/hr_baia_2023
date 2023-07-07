<?php

namespace App\Filters\Candidate;

class CandidateReligionFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        return $query->whereIn('religion_id', $ids );

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateEducationFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        return $query->whereIn('education_id', $ids );

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateNationalityFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        return $query->whereIn('nationality_id', $ids );

    }
}

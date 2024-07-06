<?php

namespace App\Filters\Candidate;

class CandidateGenderFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('gender_id', $request['id'] );
        });

    }
}

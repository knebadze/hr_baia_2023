<?php

namespace App\Filters\Candidate;

class CandidateNameFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('name_ka', 'LIKE', '%'.$request.'%' );
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateAddressFilter
{
    function __invoke($query, $request)
    {
        // $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('address_ka', 'LIKE', $request.'%');
        // });

    }
}

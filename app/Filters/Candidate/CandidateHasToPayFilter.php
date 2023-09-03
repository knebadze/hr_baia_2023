<?php

namespace App\Filters\Candidate;

class CandidateHasToPayFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('user.candidate', function ($query) {
            return $query->where('registration_fee', 0);
        });
    }
}

<?php

namespace App\Filters\Candidate;

class CandidatePaidFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('user.candidate', function ($query) {
            return $query->where('registration_fee', 1);
        });
    }
}

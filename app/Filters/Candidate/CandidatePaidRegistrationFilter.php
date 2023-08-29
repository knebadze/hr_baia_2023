<?php

namespace App\Filters\Candidate;

class CandidatePaidRegistrationFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('user.registerLog', function ($query) {
            return $query->whereNotNull('user_id')->where('type', 1);
        });
    }
}

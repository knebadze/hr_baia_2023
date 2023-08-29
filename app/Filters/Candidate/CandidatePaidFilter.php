<?php

namespace App\Filters\Candidate;

class CandidatePaidFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('user.registerLog', function ($query) {
            return $query->whereNotNull('user_id')->where('type', 1)->whereNull('enroll_date');
        });
    }
}

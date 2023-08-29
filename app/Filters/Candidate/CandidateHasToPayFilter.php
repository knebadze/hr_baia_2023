<?php

namespace App\Filters\Candidate;

class CandidateHasToPayFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('user.registerLog', function ($query) {
            return $query->whereNotNull('user_id')->where('type', 1)->whereNotNull('enroll_date');
        });
    }
}

<?php

namespace App\Filters\Candidate;

class CandidatePersonalNumberFilter
{
    function __invoke($query, $personal_number)
    {
        return $query->where('personal_number', $personal_number);
    }
}

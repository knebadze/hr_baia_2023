<?php

namespace App\Filters\Candidate;

use Carbon\Carbon;

class CandidateAgeFilter
{
    function __invoke($query, $request)
    {
        $min = Carbon::now()->subYear($request[1])->format('Y-m-d');
        $max = Carbon::now()->subYear($request[0])->format('Y-m-d');
        $query->whereHas('user', function ($query) use ( $min, $max ) {
            return $query->whereBetween('date_of_birth', [$min, $max]);
        });

    }
}

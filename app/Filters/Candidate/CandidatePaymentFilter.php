<?php

namespace App\Filters\Candidate;

class CandidatePaymentFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->whereBetween('payment', [$request[0], $request[1]]);
        });
    }
}

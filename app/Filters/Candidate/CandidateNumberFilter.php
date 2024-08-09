<?php

namespace App\Filters\Candidate;

class CandidateNumberFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ($request) {
            $query->where('number', $request);
        })->orWhere(function ($query) use ($request) {
            $query->whereHas('number', function ($query) use ($request) {
                $query->where('number', $request);
            });
        });

    }
}

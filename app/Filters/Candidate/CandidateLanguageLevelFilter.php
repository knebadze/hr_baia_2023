<?php

namespace App\Filters\Candidate;

use App\Models\Candidate;

class CandidateLanguageLevelFilter
{
    function __invoke($query, $request)
    {
        $query = Candidate::query();
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('languages', function ($query) use ( $ids ) {
            return $query->whereIn('language_level_id', $ids );
        });

    }
}

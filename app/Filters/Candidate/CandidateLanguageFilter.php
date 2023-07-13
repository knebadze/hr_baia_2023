<?php

namespace App\Filters\Candidate;

use App\Models\Candidate;

class CandidateLanguageFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('getLanguage', function ($query) use ( $ids ) {
            return $query->whereIn('language_id', $ids );
        });

    }
}

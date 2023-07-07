<?php

namespace App\Filters\Candidate;

class CandidateLanguageFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('languages', function ($query) use ( $ids ) {
            return $query->whereIn('language_id', $ids );
        });

    }
}

<?php

namespace App\Filters\Candidate;

use App\Models\Candidate;

class CandidateCharacteristicFilter
{
    function __invoke($query, $request)
    {
        // $query = Candidate::query();
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('characteristic', function ($query) use ( $ids ) {
            return $query->whereIn('general_characteristic_id', $ids );
        });

    }
}

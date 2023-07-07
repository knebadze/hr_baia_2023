<?php

namespace App\Filters\Candidate;

class CandidateCharacteristicFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('characteristic', function ($query) use ( $ids ) {
            return $query->whereIn('general_characteristic_id', $ids );
        });

    }
}

<?php

namespace App\Filters\Candidate;

class CandidateCategoryFilter
{
    function __invoke($query, $request)
    {
        $ids = is_array($request) ? collect($request)->pluck('id')->toArray() : [$request['id']];

        $query->whereHas('workInformation', function ($query) use ($ids) {
            return $query->whereIn('category_id', $ids);
        });


    }
}

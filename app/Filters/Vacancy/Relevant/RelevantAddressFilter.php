<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantAddressFilter
{
    function __invoke($query, $request)
    {
        return $query->whereHas('employer', function ($query) use ( $request ) {
            $query->where('address_ka', 'LIKE', '%'.$request.'%');
        });

    }
}

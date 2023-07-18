<?php

namespace App\Filters\Vacancy\Admin;

class vacancyEmployerNameFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('employer', function ($query) use ( $request ) {
            return $query->where('name_ka', 'LIKE', '%'.$request.'%' );
        });

    }
}

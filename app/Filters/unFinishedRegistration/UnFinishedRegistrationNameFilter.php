<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationNameFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('name_ka', 'LIKE', '%'.$request.'%' );
        });
    }
}

<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationNumberFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('user', function ($query) use ( $request ) {
            return $query->where('number', $request );
        });
    }
}

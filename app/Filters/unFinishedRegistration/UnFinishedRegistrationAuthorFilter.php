<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationAuthorFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('author_id', $ids );
    }
}

<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationStatusFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('status_id', $ids );
    }
}

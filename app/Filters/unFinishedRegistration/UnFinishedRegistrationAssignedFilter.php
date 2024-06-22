<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationAssignedFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('was_assigned_id', $ids );
    }
}

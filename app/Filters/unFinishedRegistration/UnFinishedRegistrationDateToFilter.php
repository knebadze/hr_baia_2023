<?php

namespace App\Filters\unFinishedRegistration;


class UnFinishedRegistrationDateToFilter
{
    function __invoke($query, $request)
    {
        $formattedDate = date('Y-m-d', strtotime($request));

        return $query->where('created_at', '<=', $formattedDate);
    }
}

<?php

namespace App\Filters\Reminder;

class ReminderVacancyIdFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('vacancy', function ($query) use ( $request ) {
            return $query->where('code', $request);
        });

    }
}

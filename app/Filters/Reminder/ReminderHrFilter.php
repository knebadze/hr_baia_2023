<?php

namespace App\Filters\Reminder;

use Carbon\Carbon;

class ReminderHrFilter
{
    function __invoke($query, $request)
    {
        return $query->where('hr_id', $request['hr']['id']);

    }
}

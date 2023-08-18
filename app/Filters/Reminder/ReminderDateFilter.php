<?php

namespace App\Filters\Reminder;

use Carbon\Carbon;

class ReminderDateFilter
{
    function __invoke($query, $request)
    {
        if ($request[0] == null) {
            $request[0] = Carbon::now()->toDateString();
        }
        return $query->whereDate('date', '>=', Carbon::parse($request[0])->startOfDay()->toDateTimeString())->whereDate('date', '<=', Carbon::parse($request[1])->endOfDay()->toDateTimeString());

    }
}

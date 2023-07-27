<?php

namespace App\Filters\Reminder;

use Carbon\Carbon;

class ReminderDateFilter
{
    function __invoke($query, $request)
    {
        if ($request[1] == null) {
            $request[1] = Carbon::now()->toDateString();
        }
        return $query->where('date', '>=', Carbon::parse($request[0])->startOfDay()->toDateTimeString())->where('date', '<=', Carbon::parse($request[1])->endOfDay()->toDateTimeString());

    }
}

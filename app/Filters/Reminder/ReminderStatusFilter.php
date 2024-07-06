<?php

namespace App\Filters\Reminder;

use Carbon\Carbon;

class ReminderStatusFilter
{
    function __invoke($query, $request)
    {
        $now = Carbon::now();
        if ($request['id'] == 0) {
            return $query->where('active', 0)
                    ->where(function ($query) use ($now) {
                        $query->where('date', '<', $now)
                            ->orWhere(function ($query) use ($now) {
                                $query->whereDate('date', '=', $now)
                                    ->whereTime('date', '<', $now);
                            });
                    });
        }elseif ($request['id'] == 1) {
            return $query->where('active', 0)
                ->where(function ($query) use ($now) {
                    $query->where('date', '>', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereDate('date', '=', $now)
                                ->whereTime('date', '>', $now);
                        });
                });
        }elseif ($request['id'] == 2){
            return $query->where('active', 1);
        }
    }
}

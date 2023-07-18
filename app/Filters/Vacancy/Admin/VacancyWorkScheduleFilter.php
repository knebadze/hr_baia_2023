<?php

namespace App\Filters\Vacancy\Admin;

class VacancyWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('workSchedule', function ($query) use ( $ids ) {
            return $query->whereIn('work_schedule_id', $ids);
        });

    }
}

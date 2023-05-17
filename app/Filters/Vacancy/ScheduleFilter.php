<?php


namespace App\Filters\Vacancy;


class ScheduleFilter
{
    function __invoke($query, $schedule)
    {
        $ids = [];
        foreach ($schedule as $key => $value) {
            $ids[] = $value['id'];
        }
        return $query->whereHas('workSchedule', function ($query) use ($ids ) {
            $query->whereIn('work_schedule_id', $ids);
        });
    }
}

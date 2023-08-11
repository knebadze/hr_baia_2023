<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        return $query->Where('work_schedule_id',  $request);
    }
}

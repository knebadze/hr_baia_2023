<?php

namespace App\Filters\Candidate;

class CandidateWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $ids = is_array($request) ? collect($request)->pluck('id')->toArray() : [$request['id']];
        $query->whereHas('getWorkInformation.workSchedule', function ($query) use ( $ids ) {
            return $query->whereIn('work_schedule_id', $ids);
        });

    }
}

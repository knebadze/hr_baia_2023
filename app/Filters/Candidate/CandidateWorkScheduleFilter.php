<?php

namespace App\Filters\Candidate;

class CandidateWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $ids = !array_key_exists('id', $request) ? collect($request)->pluck('id')->toArray() : [$request['id']];
        $query->whereHas('getWorkInformation.workSchedule', function ($query) use ( $ids ) {
            return $query->whereIn('work_schedule_id', $ids);
        });

    }
}

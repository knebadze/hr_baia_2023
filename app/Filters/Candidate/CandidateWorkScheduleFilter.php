<?php

namespace App\Filters\Candidate;

class CandidateWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('getWorkInformation.workSchedule', function ($query) use ( $request ) {
            return $query->where('work_schedule_id', $request['id']);
        });

    }
}

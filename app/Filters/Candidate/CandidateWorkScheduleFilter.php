<?php

namespace App\Filters\Candidate;

class CandidateWorkScheduleFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('workInformation', function ($query) use ( $request ) {
            return $query->join('work_information_work_schedules', 'id', 'work_information_work_schedules.work_information_id')
            ->where('work_schedule_id', $request['id']);
        });

    }
}

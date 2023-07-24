<?php

namespace App\Filters\Vacancy\Admin;

class VacancyInterviewPlaceFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('interviewPlace', function ($query) use ( $ids ) {
            return $query->whereIn('interview_place_id', $ids);
        });

    }
}

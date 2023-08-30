<?php

namespace App\Filters\Enrollment;


class EnrollmentHrFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        return $query->whereIn('enrollments.author_id', $ids);

    }
}

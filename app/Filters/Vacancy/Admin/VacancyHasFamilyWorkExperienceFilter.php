<?php

namespace App\Filters\Vacancy\Admin;

class VacancyHasFamilyWorkExperienceFilter
{
    function __invoke($query, $request)
    {

        $query->whereHas('demand', function ($query) use ( $request ) {
            return $query->where('has_experience', $request);
        });

    }
}

<?php

namespace App\Filters\Vacancy\Admin;

class VacancyDrivingLicenseFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('getVacancyDrivingLicense', function ($query) use ( $ids ) {
            return $query->whereIn('driving_license_id', $ids);
        });

    }
}

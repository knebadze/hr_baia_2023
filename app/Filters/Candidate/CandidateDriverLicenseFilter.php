<?php

namespace App\Filters\Candidate;

class CandidateDriverLicenseFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('drivingLicense', function ($query) use ( $ids ) {
            return $query->whereIn('driving_license_id', $ids );
        });

    }
}

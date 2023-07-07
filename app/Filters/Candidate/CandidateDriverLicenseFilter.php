<?php

namespace App\Filters\Candidate;

class CandidateDriverLicenseFilter
{
    function __invoke($query, $request)
    {
        $ids = [];
        foreach ($request as $key => $value) {
            $ids[] = $value['id'];
        }
        $query->whereHas('drivingLicense', function ($query) use ( $ids ) {
            return $query->whereIn('driver_license_id', $ids );
        });

    }
}

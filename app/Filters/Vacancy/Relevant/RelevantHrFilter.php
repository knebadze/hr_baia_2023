<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantHrFilter
{
    function __invoke($query, $request)
    {
        // dd($request);
        return $query->Where('hr_id',  $request);
    }
}

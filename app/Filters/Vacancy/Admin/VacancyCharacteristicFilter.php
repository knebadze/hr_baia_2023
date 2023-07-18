<?php

namespace App\Filters\Vacancy\Admin;

class VacancyCharacteristicFilter
{
    function __invoke($query, $request)
    {
        $ids = collect($request)->pluck('id')->toArray();
        $query->whereHas('getCharacteristic', function ($query) use ( $ids ) {
            return $query->whereIn('characteristic_id', $ids);
        });

    }
}

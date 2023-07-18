<?php

namespace App\Filters\Vacancy\Admin;

class VacancyCurrencyFilter
{
    function __invoke($query, $request)
    {
        $query->whereHas('currency', function ($query) use ( $request ) {
            return $query->where('currency_id', $request['id']);
        });

    }
}

<?php

namespace App\Filters\Vacancy\Admin;

class VacancyPaymentFilter
{
    function __invoke($query, $request)
    {
        return $query->whereBetween('payment', [$request[0], $request[1]]);;

    }
}

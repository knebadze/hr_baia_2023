<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantPaymentFilter
{
    function __invoke($query, $request)
    {
        return $query->where(function ($query) use ($request) {
            foreach ($request as $value) {
                $query->orWhere('payment', '>=', $value);
            }
        });
    }
}

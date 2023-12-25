<?php

namespace App\Filters\Vacancy\Admin;

class VacancyCodeFilter
{
    public function __invoke($query, $request)
    {
        return $query->where('code', $request);
    }
}

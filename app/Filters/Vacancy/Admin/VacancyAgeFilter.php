<?php

namespace App\Filters\Vacancy\Admin;

class VacancyAgeFilter
{
    function __invoke($query, $request)
    {
        $check = ($request[0] != 18 && $request[1] != 65);
        if ($this->hasRelationship($query) && $check) {
            $query->whereHas('demand', function ($query) use ( $request ) {
                return $query->where('min_age', '>=', $request[0])->where('max_age', '<=', $request[1]);
            });

        }else{
            return $query;
        }
    }


    protected function hasRelationship($query)
    {
        return collect($query->getEagerLoads())->has('demand');
    }
}

<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantCategoryFilter
{
    function __invoke($query, $request)
    {
        return $query->Where('category_id',  $request);
    }
}

<?php

namespace App\Filters\Vacancy;

class VacancyFilters
{
    protected $filters = [
        'word' => WordFilter::class,
        'category' => CategoryFilter::class,

        'time' => TimeFilter::class,
        // 'brand' => BrandFilter::class,
    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            $filterInstance = new $this->filters[$name];
            $query = $filterInstance($query, $value);
        }
        return $query;
    }


    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }

}

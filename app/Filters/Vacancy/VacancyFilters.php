<?php

namespace App\Filters\Vacancy;

class VacancyFilters
{
    protected $filters = [
        'category' => CategoryFilter::class,
        'schedule' => ScheduleFilter::class,
        'word' => WordFilter::class,
        'location' => LocationFilter::class,
        'time' => TimeFilter::class,
        'payment' => PaymentFilter::class,
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

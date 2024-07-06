<?php

namespace App\Filters\Vacancy\Relevant;

class RelevantFilters
{
    protected $filters = [
        'payment'=> RelevantPaymentFilter::class,
        'category' => RelevantCategoryFilter::class,
        'work_schedule' => RelevantWorkScheduleFilter::class,
        'address' => RelevantAddressFilter::class,
        'hrs' => RelevantHrFilter::class

    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            if ($value) {
                $filterInstance = new $this->filters[$name];
                $filterInstance($query, $value);
            }
        }
        return $query;
    }


    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }
}

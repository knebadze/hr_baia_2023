<?php

namespace App\Filters\unFinishedRegistration;

class UnFinishedRegistrationFilters
{
    protected $filters = [
        "author" => UnFinishedRegistrationAuthorFilter::class,
        "assigned" => UnFinishedRegistrationAssignedFilter::class,
        "status" => UnFinishedRegistrationStatusFilter::class,
        "candidate_name" => UnFinishedRegistrationNameFilter::class,
        "candidate_number" => UnFinishedRegistrationNumberFilter::class,
        "date_from" => UnFinishedRegistrationDateFromFilter::class,
        "date_to" => UnFinishedRegistrationDateToFilter::class,
        "all" => UnFinishedRegistrationAllFilter::class,
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

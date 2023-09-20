<?php

namespace App\Filters\Employer;

class EmployerFilters
{
    protected $filters = [
        'name' => EmployerNameFilter::class,
        'number' => EmployerNumberFilter::class,
        'email' => EmployerEmailFilter::class,
        'address' => EmployerAddressFilter::class,
        'date' => EmployerDateFilter::class,

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

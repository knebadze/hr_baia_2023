<?php

namespace App\Filters\Salary;

class SalaryFilters
{
    protected $filters = [
        'hr' => SalaryHrFilter::class,
        'date' => SalaryDateFilter::class,
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

<?php

namespace App\Filters\Reminder;

class ReminderFilters
{
    protected $filters = [
        'vacancy_id' => ReminderVacancyIdFilter::class,
        'hr' => ReminderHrFilter::class,
        'status' => ReminderStatusFilter::class,
        'date' => ReminderDateFilter::class
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

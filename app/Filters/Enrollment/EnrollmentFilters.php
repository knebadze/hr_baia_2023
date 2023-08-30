<?php

namespace App\Filters\Enrollment;

class EnrollmentFilters
{
    protected $filters = [
        'enrollment_type' => EnrollmentEnrollmentTypeFilter::class,
        'hr' => EnrollmentHrFilter::class,
        'code' => EnrollmentCodeFilter::class,
        'candidate_id' => EnrollmentCandidateIdFilter::class,
        'who_is_counting' => EnrollmentWhoIsCountingFilter::class,
        'name' => EnrollmentNameFilter::class,
        'type' => EnrollmentTypeFilter::class,
        'status' => EnrollmentStatusFilter::class,
        'date' => EnrollmentDateFilter::class,
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

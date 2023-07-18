<?php

namespace App\Filters\Vacancy\Admin;

class VacancyFullFilters
{
    protected $filters = [
        'name' => vacancyEmployerNameFilter::class,
        // 'number' => VacancyEmployerNumberFilter::class,
        // // 'address' => '',
        'code' => vacancyCodeFilter::class,
        'category' => VacancyCategoryFilter::class,
        'work_schedule' => VacancyWorkScheduleFilter::class,
        'payment' => VacancyPaymentFilter::class,
        'currency' => VacancyCurrencyFilter::class,
        'status' => VacancyStatusFilter::class,
        // 'age' => VacancyAgeFilter::class,
        'education' => VacancyEducationFilter::class,
        'specialty' => VacancySpecialtyFilter::class,
        'language' => VacancyLanguageFilter::class,
        'language_level' => VacancyLanguageLevelFilter::class,
        // 'driving_license' => '',
        'characteristic' => VacancyCharacteristicFilter::class,
        'created_at' => vacancyCreatedAtFilter::class,
        // 'interview_date' => '',
        // 'interview_place' => '',
        // 'start_date' => '',
        // 'term' => '',
        // 'go_vacation' => '',
        // 'stay_night' => '',
        // 'work_additional_hours' => '',
        // 'has_family_work_experience' => '',
        // 'has_recommendation' => '',
    ];

    public function apply($query)
    {
        // dd($this->receivedFilters());
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

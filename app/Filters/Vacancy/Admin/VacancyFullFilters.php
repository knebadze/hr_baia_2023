<?php

namespace App\Filters\Vacancy\Admin;

class VacancyFullFilters
{
    protected $filters = [
        'name' => VacancyEmployerNameFilter::class,
        'number' => VacancyEmployerNumberFilter::class,
        // // 'address' => '',
        'code' => VacancyCodeFilter::class,
        'category' => VacancyCategoryFilter::class,
        'work_schedule' => VacancyWorkScheduleFilter::class,
        'payment' => VacancyPaymentFilter::class,
        'currency' => VacancyCurrencyFilter::class,
        'status' => VacancyStatusFilter::class,
        'age' => VacancyAgeFilter::class,
        'education' => VacancyEducationFilter::class,
        'specialty' => VacancySpecialtyFilter::class,
        'language' => VacancyLanguageFilter::class,
        'language_level' => VacancyLanguageLevelFilter::class,
        'driving_license' => VacancyDrivingLicenseFilter::class,
        'characteristic' => VacancyCharacteristicFilter::class,
        'created_at' => vacancyCreatedAtFilter::class,
        'interview_date' => vacancyInterviewDateFilter::class,
        'interview_place' => VacancyInterviewPlaceFilter::class,
        'start_date' => VacancyStartDateFilter::class,
        'term' => VacancyTermFilter::class,
        'go_vacation' => VacancyGoVacationFilter::class,
        'stay_night' => VacancyStayNightFilter::class,
        'work_additional_hours' => VacancyWorkAdditionalHoursFilter::class,
        'has_family_work_experience' => VacancyHasFamilyWorkExperienceFilter::class,
        'has_recommendation' => VacancyHasRecommendationFilter::class,
        'hr' => VacancyHrFilter::class,
        'hrs' => VacancyHrsFilter::class,
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

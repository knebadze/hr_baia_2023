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
        'go_vacation' => vacancyGoVacationFilter::class,
        'stay_night' => vacancyStayNightFilter::class,
        'work_additional_hours' => vacancyWorkAdditionalHoursFilter::class,
        'has_family_work_experience' => VacancyHasFamilyWorkExperienceFilter::class,
        'has_recommendation' => VacancyHasRecommendationFilter::class,
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

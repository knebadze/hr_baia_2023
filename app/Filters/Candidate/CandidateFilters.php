<?php

namespace App\Filters\Candidate;

class CandidateFilters
{
    protected $filters = [
        'name' => CandidateNameFilter::class,
        'number' => CandidateNumberFilter::class,
        'personal_number' => CandidatePersonalNumberFilter::class,
        // 'address' => CandidateAddressFilter::class,
        // 'age' => '',
        'height' => CandidateHeightFilter::class,
        'weight' => CandidateWeightFilter::class,
        'gender' => CandidateGenderFilter::class,
        'nationality' => CandidateNationalityFilter::class,
        'citizenship' => CandidateCitizenshipFilter::class,
        'religion' => CandidateReligionFilter::class,
        'education' => CandidateEducationFilter::class,
        'profession' => CandidateProfessionFilter::class,
        'specialty' => CandidateSpecialtyFilter::class,
        // 'language' => CandidateLanguageFilter::class,
        // 'language_level' => CandidateLanguageLevelFilter::class,
        'drivingLicense' => CandidateDriverLicenseFilter::class,
        'allergy' => CandidateAllergyFilter::class,
        // 'characteristic' => CandidateCharacteristicFilter::class,
        // 'maritalStatus' => CandidateMaritalStatusFilter::class,
        'children' => CandidateChildrenFilter::class,
        // 'category' => CandidateCategoryFilter::class,
        // 'work_schedule' => CandidateWorkScheduleFilter::class,
        // 'payment' => CandidatePaymentFilter::class,
        'go_vacation' => CandidateGoVacationFilter::class,
        // 'stay_night' => CandidateStayNightFilter::class,
        // 'work_additional_hours' => CandidateWorkAdditionalHoursFilter::class,
        'convection' => CandidateConvectionFilter::class,
        'smoke' => CandidateSmokeFilter::class,
        'work_abroad' => CandidateWorkAbroadFilter::class,
        // 'has_general_work_experience' => '',
        // 'has_family_work_experience' => '',
        // 'has_recommendation' => '',

    ];

    public function apply($query)
    {
        foreach ($this->receivedFilters() as $name => $value) {
            if ($value) {
                $filterInstance = new $this->filters[$name];
                $query = $filterInstance($query, $value);
            }
        }
        return $query;
    }


    public function receivedFilters()
    {
        return request()->only(array_keys($this->filters));
    }

}

<?php

namespace App\Filters\Candidate;

class CandidateFilters
{
    protected $filters = [
        'id'=> CandidateIdFilter::class,
        'name' => CandidateNameFilter::class,
        'number' => CandidateNumberFilter::class,
        'personal_number' => CandidatePersonalNumberFilter::class,
        'address' => CandidateAddressFilter::class,
        'age' => CandidateAgeFilter::class,
        'height' => CandidateHeightFilter::class,
        'weight' => CandidateWeightFilter::class,
        'gender' => CandidateGenderFilter::class,
        'nationality' => CandidateNationalityFilter::class,
        'citizenship' => CandidateCitizenshipFilter::class,
        'religion' => CandidateReligionFilter::class,
        'education' => CandidateEducationFilter::class,
        'profession' => CandidateProfessionFilter::class,
        'specialty' => CandidateSpecialtyFilter::class,
        'language' => CandidateLanguageFilter::class,
        'language_level' => CandidateLanguageLevelFilter::class,
        'drivingLicense' => CandidateDriverLicenseFilter::class,
        'allergy' => CandidateAllergyFilter::class,
        'characteristic' => CandidateCharacteristicFilter::class,
        'maritalStatus' => CandidateMaritalStatusFilter::class,
        'children' => CandidateChildrenFilter::class,
        'category' => CandidateCategoryFilter::class,
        'work_schedule' => CandidateWorkScheduleFilter::class,
        'payment' => CandidatePaymentFilter::class,
        'go_vacation' => CandidateGoVacationFilter::class,
        'stay_night' => CandidateStayNightFilter::class,
        'work_additional_hours' => CandidateWorkAdditionalHoursFilter::class,
        'convection' => CandidateConvectionFilter::class,
        'smoke' => CandidateSmokeFilter::class,
        'work_abroad' => CandidateWorkAbroadFilter::class,
        'has_general_work_experience' => CandidateHasGeneralWorkExperienceFilter::class,
        'has_family_work_experience' => CandidateHasFamilyWorkExperienceFilter::class,
        'has_recommendation' => CandidateHasRecommendationFilter::class,
        'status' => CandidateStatusFilter::class,
        'my_registration' => CandidateMyRegistrationFilter::class,
        'paid_registration' => CandidatePaidRegistrationFilter::class,
        'free_registration' => CandidateFreeRegistrationFilter::class,
        'paid' => CandidatePaidFilter::class,
        'has_to_pay' => CandidateHasToPayFilter::class,
        'user_filter_payment' => CandidateUserPaymentFilter::class
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

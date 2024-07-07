<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\VacancyDemand;
use App\Models\VacancyDeposit;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditor;
use OwenIt\Auditing\Resolvers\IpAddressResolver;

class VacancyUpdateRepository
{


    public function update($data, $ip)
    {
        DB::beginTransaction();
        try {
            // Assuming validation is done elsewhere or using request validation

            $vacancy = Vacancy::findOrFail($data['id']);
            $vacancy->update($this->prepareData($data));;

            // Update VacancyDemand
            $this->updateVacancyDemand($data['demand']);

            // Update Employer
            $employer = Employer::findOrFail($data['employer']['id']);
            $employer->fill($data['employer']);
            $employer->save();

            // Sync relationships
            $this->syncRelationships($vacancy, $data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // Handle error, log it or return a response
            throw $e;
        }
    }

    private function prepareData($data) {
        $preparedData = array_intersect_key($data, array_flip([
            'title_ka', 'title_en', 'title_ru', 'slug', 'category_id', 'status_id',
            'payment', 'currency_id', 'work_schedule_id', 'additional_schedule_ka',
            'additional_schedule_en', 'additional_schedule_ru', 'comment', 'interview_date',
            'interview_place_id', 'go_vacation', 'stay_night', 'work_additional_hours',
            'start_date', 'term_id'
        ]));

        // Manually set attributes for nested array elements and transformations
        $preparedData['slug'] = str()->slug($data['title_en']); // Assuming str() is a valid helper
        $preparedData['interview_date'] = $data['interviewDate'].' '.$data['interviewTime'];
        $preparedData['work_schedule_id'] = $data['work_schedule']['id'];
        $preparedData['category_id'] = $data['category']['id'];
        $preparedData['status_id'] = $data['status']['id'];
        $preparedData['currency_id'] = $data['currency']['id'];
        $preparedData['interview_place_id'] = $data['interview_place']['id'];
        $preparedData['term_id'] = $data['term']['id'];

        return $preparedData;
    }

    private function updateVacancyDemand($demandData)
    {
        $preparedData = [
            'vacancy_id' => $demandData['vacancy_id'],
            'min_age' => $demandData['min_age'] ?? null,
            'max_age' => $demandData['max_age'] ?? null,
            'education_id' => $demandData['education']['id'] ?? null,
            'profession_id' => $demandData['specialty']['id'] ?? null,
            'additional_duty_ka' => $demandData['additional_duty_ka'] ?? null,
            'additional_duty_en' => $demandData['additional_duty_en'] ?? null,
            'additional_duty_ru' => $demandData['additional_duty_ru'] ?? null,
            'language_id' => $demandData['language']['id'] ?? null,
            'language_level_id' => $demandData['language_level']['id'] ?? null,
            'has_experience' => $demandData['has_experience'] ?? 0,
            'has_recommendation' => $demandData['has_recommendation'] ?? 0,
        ];

        // Use the prepared data for updateOrCreate
        try {
            // Use the prepared data for updateOrCreate
            VacancyDemand::updateOrCreate(
                ['vacancy_id' => $preparedData['vacancy_id']],
                $preparedData
            );
        } catch (\Exception $e) {
            // Handle the exception
            // For example, log the error and/or return a custom error response
            Log::error("Error updating vacancy demand: " . $e->getMessage());
            // Optionally rethrow or handle differently
            throw $e;
        }
    }

    private function syncRelationships($vacancy, $data)
    {
        $relations = [
            'vacancy_for_who_need' => 'syncVacancyForWhoNeed',
            'vacancy_benefit' => 'syncVacancyBenefit',
            'characteristic' => 'syncCharacteristic',
            'vacancy_duty' => 'syncVacancyDuty',
            'vacancy_driving_license' => 'syncVacancyDrivingLicense',
        ];

        foreach ($relations as $key => $method) {
            if (isset($data[$key])) {
                $ids = collect($data[$key])->pluck('id')->toArray();
                $vacancy->$method($ids);
            }
        }
    }
    function updateDeposit($data) {
        $deposit = VacancyDeposit::findOrFail($data['id']);
        if ($deposit->employer_initial_amount != $data['employer_initial_amount']) {
            if ($deposit->employer_initial_amount > $data['employer_initial_amount']) {
                $mustEmployer = $deposit->must_be_enrolled_employer - ($deposit->employer_initial_amount - $data['employer_initial_amount']);
            }else{
                $mustEmployer = $deposit->must_be_enrolled_employer + ($data['employer_initial_amount'] - $deposit->employer_initial_amount);
            }
        }else{
            $mustEmployer = $data['must_be_enrolled_employer'];
        }

        if ($deposit->candidate_initial_amount != $data['candidate_initial_amount']) {
            if ($deposit->candidate_initial_amount > $data['candidate_initial_amount']) {
                $mustCandidate = $deposit->must_be_enrolled_candidate - ($deposit->candidate_initial_amount - $data['candidate_initial_amount']);
            }else{
                $mustCandidate = $deposit->must_be_enrolled_candidate + ($data['candidate_initial_amount'] - $deposit->candidate_initial_amount);
            }
        }else{
            $mustCandidate = $data['must_be_enrolled_employer'];
        }
        VacancyDeposit::updateOrCreate(
            ['vacancy_id' => $data['vacancy_id']],
            [
                'employer_initial_amount' => $data['employer_initial_amount'],
                'must_be_enrolled_employer' => $mustEmployer,
                'must_be_enrolled_employer_date' => $data['must_be_enrolled_employer_date'],
                'candidate_initial_amount' => $data['candidate_initial_amount'],
                'must_be_enrolled_candidate' => $mustCandidate,
                'must_be_enrolled_candidate_date' => $data['must_be_enrolled_candidate_date'],
            ]
        );
    }





}

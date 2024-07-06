<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\VacancyDemand;
use App\Models\VacancyDeposit;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditor;
use OwenIt\Auditing\Resolvers\IpAddressResolver;

class VacancyUpdateRepository
{

    public function update($data, $ip){
        $id = $data['id'];
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->title_ka = $data['title_ka'];
        $vacancy->title_en = $data['title_en'];
        $vacancy->title_ru = $data['title_ru'];
        $vacancy->slug = str()->slug($data['title_en']);
        $vacancy->category_id = $data['category']['id'];
        $vacancy->status_id = $data['status']['id'];

        $vacancy->payment = $data['payment'];
        $vacancy->currency_id = $data['currency']['id'];
        $vacancy->work_schedule_id = $data['work_schedule']['id'];
        $vacancy->additional_schedule_ka = $data['additional_schedule_ka'];
        $vacancy->additional_schedule_en = $data['additional_schedule_en'];
        $vacancy->additional_schedule_ru = $data['additional_schedule_ru'];

        $vacancy->comment = $data['comment'];
        $dateTime = $data['interviewDate'].' '.$data['interviewTime'];
        $vacancy->interview_date = $dateTime;
        $vacancy->interview_place_id = $data['interview_place']['id'];


        $vacancy->go_vacation = $data['go_vacation'];
        $vacancy->stay_night = $data['stay_night'];
        $vacancy->work_additional_hours = $data['work_additional_hours'];
        $vacancy->start_date = $data['start_date'];
        $vacancy->term_id = $data['term']['id'];
        $vacancy->update();


       
            VacancyDemand::updateOrCreate(
                ['vacancy_id' => $data['demand']['vacancy_id']], // Update condition
                [
                    'vacancy_id' => $data['demand']['vacancy_id'],
                    'min_age' => $data['demand']['min_age'] ?? null,
                    'max_age' => $data['demand']['max_age'] ?? null,
                    'education_id' => $data['demand']['education']['id'] ?? null,
                    'profession_id' => $data['demand']['specialty']['id'] ?? null,
                    'additional_duty_ka' => $data['demand']['additional_duty_ka'] ?? null,
                    'additional_duty_en' => $data['demand']['additional_duty_en'] ?? null,
                    'additional_duty_ru' => $data['demand']['additional_duty_ru'] ?? null,
                    'language_id' => $data['demand']['language']['id'] ?? null,
                    'language_level_id' => $data['demand']['language_level']['id'] ?? null,
                    'has_experience' => isset($data['demand']['has_experience']) ? $data['demand']['has_experience'] : 0,
                    'has_recommendation' => isset($data['demand']['has_recommendation']) ? $data['demand']['has_recommendation']: 0,
                ]
            );

        $employer = Employer::findOrFail($data['employer']['id']);
        $employer->name_ka = $data['employer']['name_ka'];
        $employer->name_en = $data['employer']['name_en'];
        $employer->name_ru = $data['employer']['name_ru'];
        $employer->address_ka = $data['employer']['address_ka'];
        $employer->address_en = $data['employer']['address_en'];
        $employer->address_ru = $data['employer']['address_ru'];
        $employer->number = $data['employer']['number'];
        $employer->number_code_id = $data['employer']['number_code']['id'];
        $employer->email = $data['employer']['email'];
        $employer->update();

        $selectForWhoNeedId = collect($data['vacancy_for_who_need'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->syncVacancyForWhoNeed($selectForWhoNeedId);

        $selectBenefitId = collect($data['vacancy_benefit'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->syncVacancyBenefit($selectBenefitId);

        $selectCharacteristic = collect($data['characteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $vacancy->syncCharacteristic($selectCharacteristic);

        $selectDutyId = collect($data['vacancy_duty'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->syncVacancyDuty($selectDutyId);

        if (isset($data['vacancy_driving_license'])) {
            $selectDrivingLicenseId = collect($data['vacancy_driving_license'])->reduce(function ($carry, $item) {
                if($carry  == null) $carry = [];
                $carry[] = $item["id"];
                return $carry;
            }, []);
            $vacancy->syncVacancyDrivingLicense($selectDrivingLicenseId);
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

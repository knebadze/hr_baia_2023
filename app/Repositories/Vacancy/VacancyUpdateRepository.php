<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\VacancyDemand;
use App\Models\VacancyDeposit;
use Illuminate\Support\Carbon;

class VacancyUpdateRepository
{
    public function update($data){
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
        $dateTime = Carbon::createFromTimestamp(strtotime($data['interviewDate'] . $data['interviewTime']));
        $vacancy->interview_date = $dateTime;
        $vacancy->interview_place_id = $data['interview_place']['id'];


        $vacancy->go_vacation = $data['go_vacation'];
        $vacancy->stay_night = $data['stay_night'];
        $vacancy->work_additional_hours = $data['work_additional_hours'];
        $vacancy->start_date = $data['start_date'];
        $vacancy->term_id = $data['term']['id'];
        $vacancy->update();

        $demand = VacancyDemand::findOrFail($data['demand_id']);
        $demand->min_age = $data['min_age'];
        $demand->max_age = $data['max_age'];
        $demand->education_id = $data['education']['id'];
        $demand->additional_duty_ka = $data['additional_duty_ka'];
        $demand->additional_duty_en = $data['additional_duty_en'];
        $demand->additional_duty_ru = $data['additional_duty_ru'];
        $demand->language_id = $data['language']['id'];
        $demand->language_level_id = $data['language_level']['id'];
        $demand->update();

        $employer = Employer::findOrFail($data['employer_id']);
        $employer->name_ka = $data['name_ka'];
        $employer->name_en = $data['name_en'];
        $employer->name_ru = $data['name_ru'];
        $employer->address_ka = $data['address_ka'];
        $employer->address_en = $data['address_en'];
        $employer->address_ru = $data['address_ru'];
        $employer->number = $data['number'];
        $employer->number_code_id = $data['number_code']['id'];
        $employer->email = $data['email'];
        $employer->update();

        $findDeposit = VacancyDeposit::where('vacancy_id', $data['id'])->first();
        $deposit = VacancyDeposit::findOrFail($findDeposit->id);
        $deposit->must_be_enrolled_employer = (int)$data['payment'] / 2;
        $deposit->must_be_enrolled_candidate = ((int)$data['payment'] * 10) / 100;
        $deposit->update();

        $selectForWhoNeedId = collect($data['vacancy_for_who_need'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyForWhoNeed()->sync($selectForWhoNeedId);

        $selectBenefitId = collect($data['vacancy_benefit'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyBenefit()->sync($selectBenefitId);

        $selectCharacteristic = collect($data['characteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $vacancy->characteristic()->sync( $selectCharacteristic );

        $selectDutyId = collect($data['vacancy_duty'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyDuty()->sync($selectDutyId);
    }
}

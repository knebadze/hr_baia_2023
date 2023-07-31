<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\GlobalVariable;
use App\Models\HrHasVacancy;
use App\Models\RepeatHistory;
use App\Models\VacancyDemand;
use App\Models\VacancyDeposit;
use Illuminate\Support\Carbon;

class VacancyRepeatRepository{
    public function save($data)
    {

        $vacancy = new Vacancy();
        $vacancy->code = random_int(100000, 999999999);
        $vacancy->author_id = $data['employer']['id'];
        $vacancy->hr_id = $data['hr']['id'];
        $vacancy->title_ka = $data['title_ka'];
        $vacancy->title_en = $data['title_en'];
        $vacancy->title_ru = $data['title_ru'];
        $vacancy->slug = str()->slug($data['title_en']);
        $vacancy->category_id = $data['category']['id'];
        $vacancy->status_id = 1;

        $vacancy->payment = $data['payment'];
        $vacancy->currency_id = $data['currency']['id'];
        $vacancy->work_schedule_id = $data['work_schedule']['id'];
        $vacancy->additional_schedule_ka = $data['additional_schedule_ka'];
        $vacancy->additional_schedule_en = $data['additional_schedule_en'];
        $vacancy->additional_schedule_ru = $data['additional_schedule_ru'];

        $vacancy->comment = $data['comment'];
        $dateTime = $data['interview_date'];
        $vacancy->interview_date = $dateTime;
        $vacancy->interview_place_id = $data['interview_place']['id'];


        $vacancy->go_vacation = $data['go_vacation'];
        $vacancy->stay_night = $data['stay_night'];
        $vacancy->work_additional_hours = $data['work_additional_hours'];
        $vacancy->start_date = $data['start_date'];
        $vacancy->term_id = $data['term']['id'];
        $vacancy->save();

        $demand = new VacancyDemand();
        $demand->vacancy_id = $vacancy->id;

        $demand->min_age = $data['min_age'];
        $demand->max_age = $data['max_age'];
        $demand->education_id = $data['education']['id'];
        $demand->additional_duty_ka = $data['additional_duty_ka'];
        $demand->additional_duty_en = $data['additional_duty_en'];
        $demand->additional_duty_ru = $data['additional_duty_ru'];
        $demand->language_id = $data['language']['id'];
        $demand->language_level_id = $data['language_level']['id'];
        $demand->save();

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

        $deposit = new VacancyDeposit();
        $deposit->vacancy_id = $vacancy->id;
        $deposit->must_be_enrolled_employer = ((int)$data['payment'] * 10) / 100;
        $deposit->must_be_enrolled_candidate = (int)$data['payment'] / 2;
        $deposit->must_be_enrolled_candidate = (int)$data['payment'] / 2;
        $deposit->candidate_initial_amount =(int)$data['payment'] / 2;
        $candidate_percent = GlobalVariable::where('name', 'candidate_percent')->first();
        $employer_percent = GlobalVariable::where('name', 'employer_percent')->first();
        $deposit->candidate_percent = (int)$candidate_percent->meaning;
        $deposit->employer_percent = (int)$employer_percent->meaning;
        $deposit->save();

        $repeat = new RepeatHistory();
        $repeat->old_vacancy_id = $data['id'];
        $repeat->old_vacancy_id = $vacancy->id;
        $repeat->reason = $data['repeat_reason'];
        return $vacancy->code;

    }



}

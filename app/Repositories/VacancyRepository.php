<?php

namespace App\Repositories;

use App\Models\Vacancy;
use App\Models\VacancyDemand;
use Illuminate\Support\Facades\Auth;

class VacancyRepository{
    public function save($data)
    {
        $vacancy = new Vacancy();
        $vacancy->author_id = Auth::id();
        $vacancy->hr_id = $data['vacancy']['hr_id'];
        $vacancy->title_ka = $data['vacancy']['title_ka'];
        $vacancy->title_en = $data['vacancy']['title_en'];
        $vacancy->title_ru = $data['vacancy']['title_ru'];
        $vacancy->slug = str()->slug($data['vacancy']['title_en']);
        $vacancy->category_id = $data['vacancy']['category_id']['id'];
        $vacancy->status_id = 1;
        $vacancy->address_ka = $data['vacancy']['address_ka'];
        $vacancy->address_en = $data['vacancy']['address_en'];
        $vacancy->address_ru = $data['vacancy']['address_ru'];
        $vacancy->payment = $data['vacancy']['payment'];
        $vacancy->currency_id = $data['vacancy']['currency_id']['id'];
        $vacancy->work_schedule_id = $data['vacancy']['work_schedule_id']['id'];
        $vacancy->additional_schedule_ka = $data['vacancy']['additional_schedule_ka'];
        $vacancy->additional_schedule_en = $data['vacancy']['additional_schedule_en'];
        $vacancy->additional_schedule_ru = $data['vacancy']['additional_schedule_ru'];
        $vacancy->for_who_ka = $data['vacancy']['for_who_ka'];
        $vacancy->for_who_en = $data['vacancy']['for_who_en'];
        $vacancy->for_who_ru = $data['vacancy']['for_who_ru'];
        $vacancy->comment = $data['vacancy']['comment'];
        $vacancy->additional_ka = $data['vacancy']['additional_ka'];
        $vacancy->additional_en = $data['vacancy']['additional_en'];
        $vacancy->additional_ru = $data['vacancy']['additional_ru'];
        $vacancy->go_vacation = $data['vacancy']['go_vacation'];
        $vacancy->stay_night = $data['vacancy']['stay_night'];
        $vacancy->work_additional_hours = $data['vacancy']['work_additional_hours'];
        $vacancy->save();

        $demand = new VacancyDemand();
        $demand->vacancy_id = $vacancy->id;
        $demand->start_date = $data['demand']['start_date'];
        $demand->term = $data['demand']['term'];
        $demand->min_age = $data['demand']['min_age'];
        $demand->max_age = $data['demand']['max_age'];
        $demand->education_id = $data['demand']['education_id']['id'];
        $demand->additional_duty_ka = $data['demand']['additional_duty_ka'];
        $demand->additional_duty_en = $data['demand']['additional_duty_en'];
        $demand->additional_duty_ru = $data['demand']['additional_duty_ru'];
        $demand->save();

        $selectSkillId = collect($data['skill'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item["id"];
            return $carry;
        }, []);
        $vacancy->vacancyDutySkill()->sync($selectSkillId);

        $selectCharacteristic = collect($data['characteristic'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $vacancy->characteristic()->sync( $selectCharacteristic );
        return $data;
    }
}

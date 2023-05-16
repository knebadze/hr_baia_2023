<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\HrHasVacancy;
use App\Models\VacancyDemand;
use Illuminate\Support\Facades\Auth;

class VacancyRepository{
    public function save($data)
    {
        $hr_id = $this->addHrId($data['employer']['name_ka'], $data['employer']['number']);
        $employer = $this->addEmployer($data['employer']);



        $vacancy = new Vacancy();
        $vacancy->code = random_int(100000, 999999999);
        $vacancy->author_id = $employer->id;
        $vacancy->hr_id = $hr_id;
        $vacancy->title_ka = $data['vacancy']['title_ka'];
        $vacancy->title_en = $data['vacancy']['title_en'];
        $vacancy->title_ru = $data['vacancy']['title_ru'];
        $vacancy->slug = str()->slug($data['vacancy']['title_en']);
        $vacancy->category_id = $data['vacancy']['category_id']['id'];
        $vacancy->status_id = 1;

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
        $demand->language_id = $data['demand']['language_id']['id'];
        $demand->language_level_id = $data['demand']['language_level_id']['id'];
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
        return $vacancy->code;

    }


    public function addEmployer($data)
    {
        $employer = Employer::updateOrCreate(
            ['number' => $data['number']],
            [
                'name_ka' => $data['name_ka'],
                'name_en' => $data['name_en'],
                'name_ru' => $data['name_ru'],
                'address_ka' => $data['address_ka'],
                'address_en' => $data['address_en'],
                'address_ru' => $data['address_ru'],
                'email' => $data['email']

            ]
        );
        return $employer;
    }

    public function addHrId($name, $number)
    {

        //თუ დამსაქმებელს აქვს უკვე გამოგზავნილი ვაკანსია ვპოულობ hr და ისევ მას ვაწერ ამ ვაკანისას
        //rewrite ვუცვლი რადგან ერთი წრე გამოტოვოს
        $findEmployer =  Employer::where('name_ka', 'LIKE', $name.'%')->where('number', $number)->first();
        if ($findEmployer) {

            $findAuthor = Vacancy::where('author_id', $findEmployer->id)->first();
            if ($findAuthor) {
                HrHasVacancy::where('hr_id', $findAuthor->hr_id)->update(['rewrite'=> 1]);
                return $findAuthor->hr_id;
            }

        }
        $hrHasVacancy = HrHasVacancy::where('has_vacancy', 0)->get();

        if (count($hrHasVacancy)) {
            $id = null;
            foreach ($hrHasVacancy as $key => $value) {
                if ($value->is_active == 1) {
                    $id = $value->hr_id;

                    break;
                }

            }

            //თუ დაწერა ვაკანსია return
            //თუ არ დაეწერა არააქტიურობის გამო ვიწყებ ვაკანსიებიდან ჰრ ის ძებნას
            if ($id) {
                HrHasVacancy::where('hr_id', $id)->update(['has_vacancy'=> 1]);
                return $id;
            }else{
                return $this->addHrFromVacancy();
            }
        }

        //თუ არ არის ჰრ რომელსაც არ აქვს ვაკანსია მაშინ პირდაპირ ვიწყებ ვაკანიებიდან ბოლოს დაწერილი ჰრ ის ძებნას
        return $this->addHrFromVacancy();
    }

    public function addHrFromVacancy()
    {
        $vacancy = Vacancy::orderBy('id', 'DESC')->first();
        $lastHrId = HrHasVacancy::orderBy('hr_id', 'DESC')->where('is_active', 1)->first();

        //ყველა hr გარდა ბოლოს დაწერილი hr_ისა
        $hr = HrHasVacancy::orderBy('id', 'ASC')->whereNot('hr_id', $vacancy->hr_id)->where('is_active', 1)->where('rewrite', 0)->first();
        $id = $hr->hr_id;
        //თუ ბოლო ჰრ ია მაშინ იმ HR ებს რომელსაც ქონდა გადაწერილი ვაკანსია ვუცვლი სტატუს რადგან ახალ წრეზე მოხდეს მათვის ვაკანსიების დაწერა
        if ($id == $lastHrId->hr_id) {
            HrHasVacancy::where('rewrite', 1)->update(['rewrite'=> 0]);
        }
        return $id;

    }
}

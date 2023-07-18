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


    // public function addEmployer($data)
    // {

    //     $employer = Employer::updateOrCreate(
    //         ['number' => $data['number']],
    //         [
    //             'name_ka' => $data['name_ka'],
    //             'name_en' => $data['name_en'],
    //             'name_ru' => $data['name_ru'],
    //             'address_ka' => $data['address_ka'],
    //             'address_en' => $data['address_en'],
    //             'address_ru' => $data['address_ru'],
    //             'email' => $data['email'],
    //             'number_code_id' => $data['number_code_id']

    //         ]
    //     );
    //     return $employer;
    // }

    // public function addHrId($name, $number)
    // {

    //     //თუ დამსაქმებელს აქვს უკვე გამოგზავნილი ვაკანსია ვპოულობ hr და ისევ მას ვაწერ ამ ვაკანისას
    //     //rewrite ვუცვლი რადგან ერთი წრე გამოტოვოს
    //     $findEmployer =  Employer::where('name_ka', 'LIKE', $name.'%')->where('number', $number)->first();
    //     if ($findEmployer) {

    //         $findAuthor = Vacancy::where('author_id', $findEmployer->id)->first();
    //         if ($findAuthor) {
    //             HrHasVacancy::where('hr_id', $findAuthor->hr_id)->update(['rewrite'=> 1]);
    //             return $findAuthor->hr_id;
    //         }

    //     }
    //     $hrHasVacancy = HrHasVacancy::where('has_vacancy', 0)->get();

    //     if (count($hrHasVacancy)) {
    //         $id = null;
    //         foreach ($hrHasVacancy as $key => $value) {
    //             if ($value->is_active == 1) {
    //                 $id = $value->hr_id;

    //                 break;
    //             }

    //         }

    //         //თუ დაწერა ვაკანსია return
    //         //თუ არ დაეწერა არააქტიურობის გამო ვიწყებ ვაკანსიებიდან ჰრ ის ძებნას
    //         if ($id) {
    //             HrHasVacancy::where('hr_id', $id)->update(['has_vacancy'=> 1]);
    //             return $id;
    //         }else{
    //             return $this->addHrFromVacancy();
    //         }
    //     }

    //     //თუ არ არის ჰრ რომელსაც არ აქვს ვაკანსია მაშინ პირდაპირ ვიწყებ ვაკანიებიდან ბოლოს დაწერილი ჰრ ის ძებნას
    //     return $this->addHrFromVacancy();
    // }

    // public function addHrFromVacancy()
    // {
    //     $vacancy = Vacancy::orderBy('id', 'DESC')->first();
    //     $lastHrId = HrHasVacancy::orderBy('hr_id', 'DESC')->where('is_active', 1)->first();

    //     //ყველა hr გარდა ბოლოს დაწერილი hr_ისა
    //     $hr = HrHasVacancy::orderBy('id', 'ASC')->whereNot('hr_id', $vacancy->hr_id)->where('is_active', 1)->where('rewrite', 0)->first();
    //     $id = $hr->hr_id;
    //     //თუ ბოლო ჰრ ია მაშინ იმ HR ებს რომელსაც ქონდა გადაწერილი ვაკანსია ვუცვლი სტატუს რადგან ახალ წრეზე მოხდეს მათვის ვაკანსიების დაწერა
    //     if ($id == $lastHrId->hr_id) {
    //         HrHasVacancy::where('rewrite', 1)->update(['rewrite'=> 0]);
    //     }
    //     return $id;

    // }
}

<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\Employer;
use App\Models\VacancyDemand;
use App\Models\VacancyDeposit;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;

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

    function updateDeposit($data) {
        $deposit = VacancyDeposit::findOrFail($data['id']);
        $deposit->must_be_enrolled_employer = $data['must_be_enrolled_employer'];
        $deposit->must_be_enrolled_employer_date = $data['must_be_enrolled_employer_date'];
        $deposit->enrolled_employer_date = $data['enrolled_employer_date'];
        $deposit->enrolled_employer = $data['enrolled_employer'];
        $deposit->employer_percent = $data['employer_percent'];
        $deposit->must_be_enrolled_candidate = $data['must_be_enrolled_candidate'];
        $deposit->must_be_enrolled_candidate_date = $data['must_be_enrolled_candidate_date'];
        $deposit->enrolled_candidate = $data['enrolled_candidate'];
        $deposit->enrolled_candidate_date = $data['enrolled_candidate_date'];
        $deposit->candidate_percent = $data['candidate_percent'];
        $deposit->hr_bonus = $data['hr_bonus'];
        $deposit->update();
    }

    function updateStatus($data) {


        $id = $data['id'];
        // ვამოწმებ დაკავდა სტატუსში გადაყვანამდეე იძებნება თუ არაა ამ ვაკანსიაზე კადრი დაკავდაა სტატუსით
        if ($data['status']['id'] == 3) {

            if (!QualifyingCandidate::where('vacancy_id', $id)->exists()) {
                return ['type' => 'e', 'message' => 'დამატეთ დასაქმებული კანდიდატი'];
            }else{
                if (!QualifyingCandidate::where('vacancy_id', $id)->whereIn('qualifying_type_id', [6, 7])->exists()) {
                    return ['type' => 'e', 'message' => 'დამატეთ დასაქმებული კანდიდატი'];
                }
            }

            $date = Carbon::now()->addDays(7)->toDateString();
            $vacancy = VacancyDeposit::where('id', $id)->update(['must_be_enrolled_employer_date' => $date, 'must_be_enrolled_candidate_date' => $date]);
        }
        // დასრულდა სტატუსში თუ ვაკანსიას არ ყავსა კადრი დასაქმდა სტატუსში ვაბრუნებ ერორს და თუ ყავს კადრი და თანხა არ არის ჩარიცხული ვაბრუნებ ერორს
        if ($data['status']['id'] == 4){
            if (QualifyingCandidate::where('vacancy_id', $id)->whereIn('qualifying_type_id', [6, 7])->doesntExist()) {

                return ['type' => 'e', 'message' => 'ამ სტატუსის მისანიჭებლად აუცილებელია ვაკანსიას ყავდეს "დასაქმებული" კანდიდატი'];
            }else{
                $deposit = VacancyDeposit::where('vacancy_id', $id)->first();
                if ($deposit->must_be_enrolled_employer != 0 && $deposit->must_be_enrolled_candidate != 0) {
                    return ['type' => 'e', 'message' => 'ამ სტატუსის მისანიჭებლად აუცილებელია ვაკანსიის თანხა იყოს ჩარიცხული სრულად'];
                }
            }
        }

        $vacancy = Vacancy::findOrFail($id);
        // ვამოწმებ ვაკანსიის ძველ სტატუს თუ იყო გაუქმებული მაშინ უწერია გაუქმების მიზეზი და ვააბდეითებ მიზეზს null
        if ($vacancy->status_id == 5 || $vacancy->status_id == 7) {
            $vacancy->update(['status_change_reason' => NULL]);
        }
        $vacancy->status_id = $data['status']['id'];
        $vacancy->status_change_reason = $data['status_change_reason'];
        $vacancy->update();
        // ვამოწმებ უნდა კადრის სტატუსი თუ არის ვამატებ შეხსენებას
        if ($data['status']['id'] == 6) {
            $data['reminder']['vacancy_id'] = $vacancy->id;
            $this->addReminder($data['reminder']);
        }
        if ($data['status']['id'] == 4 || $data['status']['id'] == 5) {
            // $data['reminder']['vacancy_id'] = $vacancy->id;
            $this->deleteReminder($vacancy->id);
        }
        return ['type' => 's', 'message' => 'სტატუსი წარმატებით შეიცვალა'];
    }

    function addReminder($data) {
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $data['vacancy_id'];
        $auth = Auth::user();
        if ($auth->role_id == 2) {
            $hr_id = Auth::user()->hr->id;
        }else{
            $vacancy = Vacancy::where('id', $data['vacancy_id'])->select('id')->first();
            $hr_id = $vacancy->hr_id;
        }
        $reminder->hr_id = $hr_id;
        $reminder->date = $data['date'];
        $reminder->reason = $data['reason'];
        $reminder->save();
    }

    function deleteReminder($vacancyId)  {
        if (VacancyReminder::where('vacancy_id', $vacancyId)->exists()) {
                VacancyReminder::where('vacancy_id', $vacancyId)->whereDate('date', '>', Carbon::now()->toDateTimeString())->where('active', 0)->delete();
        }
    }
}

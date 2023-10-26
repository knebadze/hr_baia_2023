<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;

class VacancyStatusUpdateRepository
{
    function updateStatus($data) {


        $id = $data['id'];
        // ვამოწმებ დაკავდა სტატუსში გადაყვანამდეე იძებნება თუ არაა ამ ვაკანსიაზე კადრი დაკავდაა სტატუსით
        if ($data['status']['id'] == 3) {


            if (!QualifyingCandidate::where('vacancy_id', $id)->exists()) {
                return ['type' => 'e', 'message' => 'დამატეთ დასაქმებული კანდიდატი'];
            }else{
                if (!QualifyingCandidate::where('vacancy_id', $id)->whereIn('qualifying_type_id', [6, 7])->whereDate('end_date', '>', Carbon::today())->exists()) {
                    return ['type' => 'e', 'message' => 'დამატეთ დასაქმებული კანდიდატი'];
                }
            }

            $date = Carbon::now()->addDays(7)->toDateString();
            $vacancyDeposit = VacancyDeposit::where('vacancy_id', $id)->update(['must_be_enrolled_employer_date' => $date, 'must_be_enrolled_candidate_date' => $date]);
            $vacancy = Vacancy::where('id', $id)->first();
            $this->dailyWorkEvent($vacancy->hr_id);

            $this->addReminder(['vacancy_id' => $id, 'date' => $date.' 10:00:00', 'reason' =>  'ვაკანსიაზე უნდა მოხდეს თანხის ჩარიცხვა']);

        }
        // დასრულდა სტატუსში თუ ვაკანსიას არ ყავსა კადრი დასაქმდა სტატუსში ვაბრუნებ ერორს და თუ ყავს კადრი და თანხა არ არის ჩარიცხული ვაბრუნებ ერორს
        // if ($data['status']['id'] == 4){
        //     if (QualifyingCandidate::where('vacancy_id', $id)->whereIn('qualifying_type_id', [6, 7])->doesntExist()) {

        //         return ['type' => 'e', 'message' => 'ამ სტატუსის მისანიჭებლად აუცილებელია ვაკანსიას ყავდეს "დასაქმებული" კანდიდატი'];
        //     }else{
        //         $deposit = VacancyDeposit::where('vacancy_id', $id)->first();
        //         if ($deposit->must_be_enrolled_employer != 0 && $deposit->must_be_enrolled_candidate != 0) {
        //             return ['type' => 'e', 'message' => 'ამ სტატუსის მისანიჭებლად აუცილებელია ვაკანსიის თანხა იყოს ჩარიცხული სრულად'];
        //         }
        //     }
        // }

        $vacancy = Vacancy::findOrFail($id);
        // ვამოწმებ ვაკანსიის ძველ სტატუს თუ იყო გაუქმებული მაშინ უწერია გაუქმების მიზეზი და ვააბდეითებ მიზეზს null
        if ($vacancy->status_id == 5 || $vacancy->status_id == 7) {
            $vacancy->update(['status_change_reason' => NULL]);
        }
        $vacancy->status_id = $data['status']['id'];
        $vacancy->status_change_reason = $data['status_change_reason'];
        $vacancy->update();
        // ვამოწმებ ვაკანსიას თუ გადავიდა წარმოებაში ვამატებ დეპოზიტს
        if ($data['status']['id'] == 2) {
            $this->addDeposit($vacancy->id);
        }
        // ვამოწმებ უნდა კადრის სტატუსი თუ არის ვამატებ შეხსენებას
        if ($data['status']['id'] == 6) {
            $data['reminder']['vacancy_id'] = $vacancy->id;
            $this->addReminder($data['reminder']);
        }
        if ($data['status']['id'] == 4 || $data['status']['id'] == 5) {
            $this->deleteReminder($vacancy->id);
            $this->deleteDeposit($vacancy->id);
        }
        if ($data['status']['id'] == 7) {
            $vacancy->update(['start_date', $data['suspended_date']]);
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

    function deleteDeposit($vacancyId) {
        return VacancyDeposit::where('vacancy_id', $vacancyId)->delete();
    }

    function addDeposit($vacancy_id){
        if (!VacancyDeposit::where('vacancy_id', $vacancy_id)->exists()) {
            $vacancy = Vacancy::where('id', $vacancy_id)->select('id', 'payment')->first();
            $deposit = new VacancyDeposit();
            $deposit->vacancy_id = $vacancy->id;
            $deposit->must_be_enrolled_employer = ((int)$vacancy->payment * 10) / 100;
            $deposit->employer_initial_amount = ((int)$vacancy->payment * 10) / 100;
            $deposit->must_be_enrolled_candidate = (int)$vacancy->payment / 2;
            $deposit->candidate_initial_amount =(int)$vacancy->payment / 2;
            $deposit->save();
        }
    }

    function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }


}

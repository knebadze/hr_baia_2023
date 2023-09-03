<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\VacancyDeposit;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use App\Models\RegistrationFee;
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
            $vacancy = VacancyDeposit::where('vacancy_id', $id)->update(['must_be_enrolled_employer_date' => $date, 'must_be_enrolled_candidate_date' => $date]);
            
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
        // ვამოწმებ უნდა კადრის სტატუსი თუ არის ვამატებ შეხსენებას
        if ($data['status']['id'] == 6) {
            $data['reminder']['vacancy_id'] = $vacancy->id;
            $this->addReminder($data['reminder']);
        }
        if ($data['status']['id'] == 4 || $data['status']['id'] == 5) {
            $this->deleteReminder($vacancy->id);
            $this->deleteDeposit($vacancy->id);
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


}

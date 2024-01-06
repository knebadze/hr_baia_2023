<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class VacancyStatusUpdateRepository
{

    function update($data)  {
        try {
            if ($data['status']['id'] == 3) {
                $candidate = QualifyingCandidate::where('vacancy_id', $data['id'])->whereIn('qualifying_type_id', [6, 7])->exists();
                if (!$candidate) {
                    return ['type' => 'w', 'message' => 'აუცილებელია ვაკანსიას ყავდეს დასაქმებული კანდიდატი'];
                }
            }
            Vacancy::where('id', $data['id'])->update(['status_id' => $data['status']['id'], 'status_change_reason' => $data['status_change_reason'], 'reason_for_cancel_id' => $data['reason_for_cancel']['id']??null]);
            return ['type' => 's', 'message' => 'სტატუსი წარმატებით შეიცვალა'];
        } catch (\Throwable $th) {
            throw $th;
            return ['type' => 'e', 'message' => 'სტატუსი შეცვლა ვერ მოხერხდა'];
        }
    }

    function updateDepositData($vacancy_id, $date)  {
        $vacancyDeposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->first();

        if (!$vacancyDeposit->must_be_enrolled_employer_date && !$vacancyDeposit->must_be_enrolled_candidate_date) {
            $vacancyDeposit->update(['must_be_enrolled_employer_date' => $date, 'must_be_enrolled_candidate_date' => $date]);
        }
    }

    function addReminder($data, $stage = null) {
        VacancyReminder::where('vacancy_id', $data['vacancy_id'])->where('main', 1)->where('active', 0)->update(['active' => 1]);
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $data['vacancy_id'];
        $reminder->hr_id = $data['hr_id'];
        $reminder->main = 1;
        if ($stage !== null) {
            $reminder->main_stage_id = $stage;
        }
        $reminder->date = $data['date'];
        $reminder->reason = $data['reason'];
        $reminder->save();
    }

    function deleteReminder($vacancyId)  {
        if (VacancyReminder::where('vacancy_id', $vacancyId)->exists()) {
                VacancyReminder::where('vacancy_id', $vacancyId)->delete();
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

        }else{
            $deposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->first();
        }
        return $deposit;
    }

    function updateQualifying($vacancy_id)  {
        if (QualifyingCandidate::where('vacancy_id', $vacancy_id)->whereIn('qualifying_type_id', [3, 5])->whereNull('status_id')->exists()) {
            QualifyingCandidate::where('vacancy_id', $vacancy_id)->whereIn('qualifying_type_id', [3, 5])->whereNull('status_id')->update(['status_id' => 2]);
        }
    }


    function sendSms($data, $type = 'vacancy_production_status_employer')
    {
        event(new SmsNotificationEvent($data, $type));
    }



}

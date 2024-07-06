<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Models\Candidate;
use App\Models\VacancyDeposit;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use App\Events\SmsNotificationEvent;

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
            $vacancy = Vacancy::where('id', $data['id'])->first();
            $vacancy->status_id = $data['status']['id'];
            $vacancy->status_change_reason = $data['status_change_reason'];
            $vacancy->reason_for_cancel_id = $data['reason_for_cancel']?$data['reason_for_cancel']['id'] : null;
            $vacancy->update();
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
        // Fetch qualifying candidates to be updated
        $qualifyingUpdate = QualifyingCandidate::where('vacancy_id', $vacancy_id)
            ->whereNotIn('qualifying_type_id', [7, 8])
            ->where('status_id', 17)
            ->get();

        // Update status_id for qualifying candidates
        $qualifyingCandidateIds = $qualifyingUpdate->pluck('id');
        QualifyingCandidate::whereIn('id', $qualifyingCandidateIds)->update(['status_id' => 19]);

        // Fetch candidate IDs to be updated
        $candidateIds = $qualifyingUpdate->pluck('candidate_id')->toArray();

        // Update status_id for candidates
        Candidate::whereIn('id', $candidateIds)
            ->whereIn('status_id', [14, 15])
            ->whereDoesntHave('qualifyingCandidate', function ($query) use ($vacancy_id) {
                $query->where('vacancy_id', '!=', $vacancy_id)
                      ->where(function ($q) {
                          $q->whereIn('qualifying_type_id', [5, 6])
                            ->where('status_id', '!=', 17)
                            ->orWhereNull('status_id');
                      });
            })
            ->update(['status_id' => 9]);
    }


    function sendSms($data, $type = 'vacancy_production_status_employer')
    {
        event(new SmsNotificationEvent($data, $type));
    }



}

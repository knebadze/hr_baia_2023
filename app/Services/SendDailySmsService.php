<?php

namespace App\Services;

use App\Models\Vacancy;
use Illuminate\Support\Carbon;
use App\Models\QualifyingCandidate;
use App\Events\SmsNotificationEvent;


class SendDailySmsService
{
    function check(){
        $currentDate = Carbon::today();

        $probationPeriod = QualifyingCandidate::query()
            ->where('qualifying_type_id', 5)
            ->whereNull('status_id')
            ->when($currentDate, function ($query) use ($currentDate) {
                $query->whereDate('start_date', '<=', $currentDate)
                    ->whereDate('end_date', '>=', $currentDate);
            })
            ->get();
        if ($probationPeriod) {
            $this->sendSms();
        }
        $depositReminder = Vacancy::where('status_id', 3)
            ->whereHas('deposit', function ($query) {
                return $query->whereNot('must_be_enrolled_employer', 0)->orWhereNot('must_be_enrolled_candidate', 0);
            })->get();

        $whereEmployerDateMoreThanCurrent = $depositReminder->filter(function ($vacancy) use ($currentDate) {
            return $vacancy->deposit->must_be_enrolled_employer_date > $currentDate;
        });

        $whereEmployerDateLessThanCurrent = $depositReminder->filter(function ($vacancy) use ($currentDate) {
            return $vacancy->deposit->must_be_enrolled_employer_date <= $currentDate;
        });

        $whereCandidateDateMoreThanCurrent = $depositReminder->filter(function ($vacancy) use ($currentDate) {
            return $vacancy->deposit->must_be_enrolled_candidate_date > $currentDate;
        });

        $whereCandidateDateLessThanCurrent = $depositReminder->filter(function ($vacancy) use ($currentDate) {
            return $vacancy->deposit->must_be_enrolled_candidate_date <= $currentDate;
        });

        if($whereEmployerDateMoreThanCurrent){
            $data = [
                'to' => $depositReminder->employer->number,
                'name' => $depositReminder->employer->name_ka,
                'money' => $depositReminder->deposit->must_be_enrolled_employer,
                'date' => $depositReminder->deposit->must_be_enrolled_employer_date
            ];
            $name = 'deposit_enrolled_candidate_or_employer';
        }
        if($whereCandidateDateMoreThanCurrent){
            $data = [
                'to' => $depositReminder->employer->number,
                'name' => $depositReminder->employer->name_ka,
                'money' => $depositReminder->deposit->must_be_enrolled_employer,
                'date' => $depositReminder->deposit->must_be_enrolled_employer_date
            ];
            $name = 'deposit_enrolled_candidate_or_employer';
        }
    }

    function hrBlock(){
        
    }

    function sendSms(){
        event(new SmsNotificationEvent('data', 'name'));
    }
}

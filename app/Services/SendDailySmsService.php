<?php

namespace App\Services;

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

        
    }

    function sendSms(){
        event(new SmsNotificationEvent('data', 'name'));
    }
}

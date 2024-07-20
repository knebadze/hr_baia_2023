<?php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class  SmsService
{
    function sendSms($phone_number, $message, $type = 'default') {
        try {
            $apiUrl = config('services.smsservicege.api_url');
            $username = config('services.smsservicege.username');
            $password = config('services.smsservicege.password');
            $client_id = config('services.smsservicege.client_id');
            $service_id = config('services.smsservicege.service_id');
            $to = $phone_number;
            $encodedMessage = urlencode($message);

            // $generatedUrl = "{$apiUrl}?username={$username}&password={$password}&client_id={$client_id}&service_id={$service_id}&to=+995{$to}&text={$encodedMessage}&utf=8";

            // $response = Http::get($generatedUrl);
            $this->createLog($phone_number, $message, $type);
            return [];
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error sending SMS: ' . $e->getMessage());

            // Return a default error status
            return 500;
        }
    }

    function createLog($phone_number, $message, $type = 'default') {
        $template_id = SmsTemplate::where('name', $type)->first()->id;
        SmsLog::create([
            'phone_number' => $phone_number,
            'message' => $message,
            'sms_template_id' => $template_id
        ]);
    }
}

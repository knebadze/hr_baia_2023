<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class  SmsService
{
    function sendSms($phone_number, $message) {
        $apiUrl = config('services.smsservicege.api_url');
        $username = config('services.smsservicege.username');
        $password = config('services.smsservicege.password');
        $client_id = config('services.smsservicege.client_id');
        $service_id = config('services.smsservicege.service_id');
        $to = $phone_number;
        $encodedMessage = urlencode($message);



        $generatedUrl = "{$apiUrl}?username={$username}&password={$password}&client_id={$client_id}&service_id={$service_id}&to=+995{$to}&text={$encodedMessage}&utf=8";

        $response = Http::get($generatedUrl);

        // dd($response->body(), $response->status(), $response->headers());

        return $response->status();
    }
}

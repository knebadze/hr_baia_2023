<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class  SmsService
{
    function sendSms($phoneNumber, $message) {
        $apiUrl = config('services.smsservicege.api_url');
        $username = config('services.smsservicege.username');
        $password = config('services.smsservicege.password');
        $client_id = config('services.smsservicege.client_id');
        $service_id = config('services.smsservicege.service_id');
        $to = $phoneNumber;
        $text = $message;

        $generatedUrl = "{$apiUrl}?username={$username}&password={$password}&client_id={$client_id}&service_id={$service_id}&to=+995{$to}&text={$text}&utf=8";
        $response = Http::get($generatedUrl);
        // dd($response);
        // dd($response->body(), $response->status(), $response->headers());

        // if ($response->successful()) {
        //     // Handle the successful response
        //     $responseData = $response->json();
        //     dd('successful',$responseData);
        // } else {
        //     // Handle the error response
        //     $errorResponse = $response->json();
        //     dd('error',$errorResponse);
        // }
    }
}

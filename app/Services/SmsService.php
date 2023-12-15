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
        $text = $message;

        $generatedUrl = "{$apiUrl}?username={$username}&password={$password}&client_id={$client_id}&service_id={$service_id}&to=+995{$to}&text={$text}&utf=8";
        $response = Http::get($generatedUrl);
        // $encodedMessage = urlencode($message);

        // // dd($encodedMessage);
        // $response = Http::post(
        //     $apiUrl, [
        //     'username' => $username,
        //     'password' => $password,
        //     'client_id' => $client_id,
        //     'service_id' => $service_id,
        //     'to' => $phone_number,
        //     'text' => $encodedMessage,
        // ]);

        // dd($response);
        // dd($response->body(), $response->status(), $response->headers());
        // // $substring = substr($response->body(), 0, 4);
        // if ($response->successful()) {
        //     // Handle the successful response
        //     $responseData = $response->json();
        //     dd('successful',$responseData);
        // } else {
        //     // Handle the error response
        //     $errorResponse = $response->json();
        //     dd('error',$errorResponse);
        // }
        return $response->status();
    }
}
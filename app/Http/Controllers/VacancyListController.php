<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Events\SmsNotificationEvent;

class VacancyListController extends Controller
{
    public function index($ids)
    {
        $vacancy = Vacancy::whereIn('code', $ids)->get();
        return view ('vacancy_list');
    }

    public function sendVacancyToCandidate(Request $request){
        $to = $request->input('to');
        $ids = $request->input('ids');
        $type = $request->input('type');
    
        if ($type == 1) {
            // Logic to send SMS
            $data = [
                'to' => $to,
                'link' => route('list.vacancy', ['ids' => $ids])
            ];
            event(new SmsNotificationEvent($data, 'send_vacancies_to_candidate'));
            return response()->json(['message' => 'SMS sent successfully']);
        } elseif ($type == 2) {
            // Logic to send Email
            
            return response()->json(['message' => 'Email sent successfully']);
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }
    }
}

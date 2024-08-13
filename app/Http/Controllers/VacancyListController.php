<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VacancyListNotification;

class VacancyListController extends Controller
{
    public function index($lang, $ids)
    {
        $idsArray = array_map('intval', explode(',', trim($ids, '[]')));
        // Fetch vacancies based on the ids
        $vacancy = Vacancy::orderby('updated_at', 'DESC')
            ->whereIn('code', $idsArray)
            ->whereIn('status_id', [2, 6, 7])
                ->with([
                    'author',
                    'currency',
                    'category',
                    'workSchedule',
                    'vacancyForWhoNeed',
                    'vacancyBenefit',
                    'hr',
                    'qualifyingCandidate',
                    'vacancyInterest'
                ])
            ->get();
            $auth = null;
            $check = Auth::guard('web')->check();
            if ($check) {
                $auth = User::where('id', Auth::guard('web')->id())->with('candidate')->first();
            }
            $checkStaff = Auth::guard('staff')->check();
            if ($checkStaff) {
                $auth = Staff::where('id', Auth::guard('staff')->id())->first();
            }
            $data = [
                'vacancies' => $vacancy,
                'auth' => $auth
            ];
        return view ('vacancy_list', compact('data'));
    }

    public function sendVacancyToCandidate(Request $request){
        $to = $request->input('to');
        $ids = $request->input('ids');
        $type = $request->input('type');

        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        $link = route('list.vacancy', ['locale' => app()->getLocale(), 'ids' => $ids]);
        if ($type == 1) {
            // Logic to send SMS
            $data = [
                'to' => $to,
                'link' => $link
            ];
            event(new SmsNotificationEvent($data, 'send_vacancies_to_candidate'));
            return response()->json(['message' => 'SMS sent successfully']);
        } elseif ($type == 2) {
            $data = [
                'to' => $to,
                'link' => $link
            ];
            Mail::to($to)->send(new VacancyListNotification($data));

            return response()->json(['message' => 'Email sent successfully']);
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }
    }
}

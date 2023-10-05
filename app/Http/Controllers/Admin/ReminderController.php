<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\VacancyReminder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\ReminderService;
use App\Filters\Reminder\ReminderFilters;

class ReminderController extends Controller
{
    private ReminderService $reminderService;
    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService = $reminderService;
    }
    function index()  {
        $data = $this->reminderService->data();
        return view('admin.reminder', compact('data'));
    }

    function addReminder(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->reminderService->add($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function update(Request $request)  {
        // dd($request->data['id']);
        $result = ['status' => 200];

        try {
            VacancyReminder::where('id', $request->data['id'])->update(['date' => $request->data['date'], 'reason' => $request->data['reason']]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function filter(ReminderFilters $filters){
        if (Auth::user()->role_id == 1) {
            $data = VacancyReminder::filter($filters)->orderby('date', 'DESC')->with(['vacancy', 'hr.user'])->get();
        } else{
            $data = VacancyReminder::filter($filters)->orderby('date', 'DESC')->where('hr_id', Auth::user()->hr->id)->with('vacancy')->get();
        }

        return response()->json($data);
    }

    function getReminderInfo(Request $request)  {
        // dd(Carbon::now()->toDateTimeString());
        $history = VacancyReminder::orderBy('id', 'DESC')->where('vacancy_id', $request->data)->where('date', '<', Carbon::now()->toDateTimeString())->get();
        $next = VacancyReminder::orderBy('id', 'DESC')->where('vacancy_id', $request->data)->where('date', '>', Carbon::now()->toDateTimeString())->get();
        $data = ['history' => $history, 'next' => $next];
        return response()->json($data);
    }

    function hrReminderInfo()  {
        $vacancyReminder = VacancyReminder::orderBy('date', 'ASC')
                ->where('hr_id', Auth::user()->hr->id)
                ->where('active', 0)
                ->where('date', '>=', Carbon::now()->toDateTimeString())
                ->with('vacancy')
                ->get();
        $data = [];
        $currentDateTime = Carbon::now();
        foreach ($vacancyReminder as $key => $value) {
            $baseDateTime = Carbon::parse($value->date);
            if ($currentDateTime->lt($baseDateTime) && $currentDateTime->diffInMinutes($baseDateTime) <= 30) {
                $data[] = $value;
            }
        }
        // Assuming the base time is in the 'date' property of the first item in $data

        // dd($currentDateTime->diffInMinutes($baseDateTime));
        return response()->json($data);
    }


}

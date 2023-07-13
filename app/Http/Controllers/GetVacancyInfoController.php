<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VacancyReminder;
use App\Models\VacancyRedactedHistory;
use App\Services\ClassificatoryService;

class GetVacancyInfoController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }
    public function getClassificatory(){
        $classificatoryArr = ['numberOwner', 'currency', 'workSchedule', 'educations', 'characteristic', 'numberCode',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        return response()->json($classificatory);
    }
    function getVacancyFilterClassificatory(){
        $classificatoryArr = ['currency', 'workSchedule', 'educations', 'characteristic',
        'category', 'forWhoNeed', 'term', 'benefit','specialties', 'languages', 'languageLevels', 'duty', 'interviewPlace', 'status'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        return response()->json($classificatory);
    }

    public function statusChangeInfo(Request $request) {

        $history = VacancyRedactedHistory::where('vacancy_id', $request->data)->where('column_name', 'status')->get();
        $data = ['history' => $history, 'status' => Status::all()->toArray()];
        return response()->json($data);
    }

    function getReminderInfo(Request $request)  {
        // dd(Carbon::now()->toDateTimeString());
        $history = VacancyReminder::orderBy('id', 'DESC')->where('vacancy_id', $request->data)->where('date', '<', Carbon::now()->toDateTimeString())->get();
        $next = VacancyReminder::orderBy('id', 'DESC')->where('vacancy_id', $request->data)->where('date', '>', Carbon::now()->toDateTimeString())->get();
        $data = ['history' => $history, 'next' => $next];
        return response()->json($data);
    }

}

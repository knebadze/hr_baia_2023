<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
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
    function getAddPersonalWasEmployedInfo(Request $request)  {
        // dd($request->data);
        $data = QualifyingCandidate::where('vacancy_id', $request->data)->with(['candidate.user', 'qualifyingType'])->get();
        return response()->json($data);
    }
    function getVacancyFullInfo(Request $request)  {
        $data = Vacancy::where('id', $request->data)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
            ])->first();
        return response()->json($data);
    }

    function vacancyRedactedHistory(Request $request) {
        $data = VacancyRedactedHistory::orderBy('created_at', 'DESC')->where('vacancy_id', $request->data)->with('hr.user')->get();
        return response()->json($data);
    }

}

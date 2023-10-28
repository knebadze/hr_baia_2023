<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Status;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;
use App\Models\QualifyingType;
use Illuminate\Support\Facades\Auth;
use App\Models\VacancyRedactedHistory;
use App\Services\ClassificatoryService;

class GetVacancyInfoController extends Controller
{
    private ClassificatoryService $classificatoryService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
    }

    public function getClassificatory(Request $request){

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
        $data = ['history' => $history, 'status' => Status::where('status_type_id', 1)->get()->toArray(), 'role_id' => Auth::user()->role_id];
        return response()->json($data);
    }



    function getVacancyFullInfo(Request $request)  {

        $vacancy = Vacancy::where('id', $request->data)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit','hr.user', 'vacancyDrivingLicense'
            ])->first();

        $hr_id = (Auth::user()->role_id == 2)?Auth::user()->hr->id:null;
        $data = ['vacancy' => $vacancy, 'hr_id' => $hr_id];

        return response()->json($data);
    }

    function vacancyRedactedHistory(Request $request) {
        $data = VacancyRedactedHistory::orderBy('created_at', 'DESC')
                ->where('vacancy_id', $request->data)
                ->leftJoin('users', 'users.id', 'vacancy_redacted_histories.user_id')
                // ->with('user')
                ->select('vacancy_redacted_histories.*', 'users.name_ka as name')
                ->get()->toArray();
        // dd($data);
        return response()->json($data);
    }



    function findVacancy(Request $request) {
        // dd($request->data);
        $data = Vacancy::where('code', 'LIKE', $request->data.'%')->where('status_id', 2)->with(['employer', 'category', 'status', 'hr.user', 'interviewPlace'])->get()->toArray();
        // dd($request->data);
        return response()->json($data);
    }

}

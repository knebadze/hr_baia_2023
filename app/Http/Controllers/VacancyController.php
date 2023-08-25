<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;
use App\Services\InterestCandidateService;

class VacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private VacancyService $vacancyService;
    private InterestCandidateService $interestCandidateService;
    public function __construct(ClassificatoryService $classificatoryService, VacancyService $vacancyService, InterestCandidateService $interestCandidateService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->vacancyService = $vacancyService;
        $this->interestCandidateService = $interestCandidateService;
    }

    // index
    public function index()
    {

        $classificatoryArr = ['category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = [
            'classificatory' => $classificatory
        ];
        return view ('individual', compact('data'));
    }
    public function data(Request $request)
    {

        $vacancy = Vacancy::orderby('updated_at', 'DESC')->whereIn('status_id', [2, 6])->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr.user'])->paginate(20)->toArray();
        // dd($vacancy);
        $countVacancy = Vacancy::whereIn('status_id', [2, 6])->count();
        $auth = User::where('id', Auth::id())->with('candidate')->first();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy,
            'auth' => $auth
        ];
        return response($data);
    }

    public function filter(VacancyFilters $filters)
    {
        $vacancy = Vacancy::filter($filters)->orderby('updated_at', 'DESC')->with(['author','currency', 'category', 'workSchedule'])->paginate(25)->toArray();;
        $countVacancy = Vacancy::filter($filters)->count();
        $data = [
            'vacancy' => $vacancy,
            'count' => $countVacancy
        ];
        return $data;
    }

    public function searchForId($id, $array) {

        foreach (json_decode(json_encode($array), true) as $key => $val) {
            if ($val['user_id'] == $id) {
                return true;
            }
        }
        return false;
    }
    public function show($lang, $id, $slug) {
        $vacancy = Vacancy::where('id', $id)
            ->with([
                'author',
                'currency',
                'category',
                'vacancyForWhoNeed',
                'hr.user',
                'workSchedule',
                'demand.education',
                'demand.specialty',
                'demand.language',
                'vacancyBenefit',
                'vacancyDuty'
                ])
            ->first();
        $findCandidate = (Auth::check())?QualifyingCandidate::where('vacancy_id', $vacancy->id)->where('candidate_id', Auth::user()->candidate->id)->first():null;
        $statusThisVacancy = ($findCandidate)?$findCandidate->qualifyingType:null;
        $auth = User::where('id', Auth::id())->with('candidate')->first();
        $data = ['vacancy' => $vacancy, 'statusThisVacancy' => $statusThisVacancy, 'applicants' => count($vacancy->vacancyInterest), 'auth' => $auth];
        $vacancy->increment('view', 1);
        return view('job_detail', compact('data'));
    }

    function interest(Request $request){

        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->interestCandidateService->service($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
        // $qualifying = new QualifyingCandidate();
        // $qualifying->vacancy_id = $request->id;
        // $qualifying->qualifying_type_id = 2;
        // $qualifying->candidate_id = Auth::user()->candidate->id;
        // $qualifying->save();
        // if (isset($request->_token)) {
        //     return back();
        // }
        // return response()->json($qualifying);
    }

    // function addInterest(Request $request){
    //     dd($request->_token);

    // }


}

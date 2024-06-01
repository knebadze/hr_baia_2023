<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Http\JsonResponse;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Services\ClassificatoryService;
use App\Services\InterestCandidateService;

class VacancyController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private InterestCandidateService $interestCandidateService;
    public function __construct(ClassificatoryService $classificatoryService, InterestCandidateService $interestCandidateService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->interestCandidateService = $interestCandidateService;
    }

    // index
    public function index()
    {
        return view ('job');
    }

    function fetch() : JsonResponse {
        try {
            $query = Vacancy::orderby('updated_at', 'DESC')
                ->whereIn('status_id', [2, 6, 7])
                ->with([
                    'author',
                    'currency',
                    'category',
                    'workSchedule',
                    'vacancyForWhoNeed',
                    'vacancyBenefit',
                    'hr.user',
                    'qualifyingCandidate'
                ]);

            $vacancy = $query->paginate(25)->toArray();
            $total = $query->count();

            $data = [
                'vacancy' => $vacancy,
                'total' => $total,
            ];
            $data = array_merge($data, $this->addData());
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    function addData()  {
        $classificatoryArr = ['category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $auth = User::where('id', Auth::id())->with('candidate')->first();
        return ['classificatory' => $classificatory, 'authUser' => $auth];
    }
    // public function data(Request $request)
    // {

    //     $vacancy = Vacancy::orderby('updated_at', 'DESC')->whereIn('status_id', [2, 6])->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr.user'])->paginate(25)->toArray();
    //     // dd($vacancy);
    //     // $countVacancy = Vacancy::whereIn('status_id', [2, 6])->count();
    //     $auth = User::where('id', Auth::id())->with('candidate')->first();
    //     $data = [
    //         'vacancy' => $vacancy,
    //         // 'count' => $countVacancy,
    //         'auth' => $auth
    //     ];
    //     return response($data);
    // }

    public function filter(VacancyFilters $filters)
    {
        try {
            $query = Vacancy::filter($filters)->orderby('updated_at', 'DESC')
            ->whereIn('status_id', [2, 6])
            ->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'qualifyingCandidate', 'hr.user']);

            $vacancy = $query->paginate(25)->toArray();
            $total = $query->count();
            $data = [
                'vacancy' => $vacancy,
                'total' => $total
            ];
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function searchForId($id, $array) {

        foreach (json_decode(json_encode($array), true) as $key => $val) {
            if ($val['user_id'] == $id) {
                return true;
            }
        }
        return false;
    }
    public function show($lang, $id, $slug=null) {
        // dd($lang, $id, $slug);
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
                'vacancyDuty',
                'qualifyingCandidate'
                ])
            ->first();
            // dd($vacancy->toArray());
        $findCandidate = (Auth::check() && Auth::user()->role_id == 3)?QualifyingCandidate::where('vacancy_id', $vacancy->id)->where('candidate_id', Auth::user()->candidate->id)->first():null;
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
    }

    public function search(Request $request, $lang, $category_id = null, $work_schedule_id = null, $address = null){
        // dd($category_id);
        $category_id = ($category_id)?intval(trim($category_id, '[]')):$request->input('category_id', $category_id);
        $work_schedule_id = $request->input('work_schedule_id', $work_schedule_id);
        $address = $request->input('address', $address);
        $query = Vacancy::orderby('updated_at', 'DESC')
            ->whereIn('status_id', [2, 6])
            ->where('category_id', $category_id)
            ->when($work_schedule_id, function ($query) use($work_schedule_id) {
                return $query->where('work_schedule_id', $work_schedule_id);
            })
            ->when($address, function ($query) use($address) {
                return $query->whereHas('employer', function ($query) use($address) {
                    return $query->where('address_ka', 'LIKE', '%'.$address.'%')
                    ->orWhere('address_en', 'LIKE', '%'.$address.'%')
                    ->orWhere('address_ru', 'LIKE', '%'.$address.'%');
                });
            })
            ->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr.user']);

            $vacancy = $query->paginate(25)->toArray();
            $total = $query->count();
            $data = [
                'vacancy' => $vacancy,
            ];
            $data = array_merge($data, $this->addData());
        return view('job_search', compact('data'));

    }




}

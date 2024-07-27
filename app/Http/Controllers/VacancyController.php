<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use App\Services\VacancyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Filters\Vacancy\VacancyFilters;
use App\Models\Staff;
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
                    'hr',
                    'qualifyingCandidate',
                    'vacancyInterest'
                ]);

                $paginatedVacancies = $query->paginate(25);
                $vacancy = $paginatedVacancies->toArray();

                // Use the total from the paginator instead of counting the query again
                $total = $paginatedVacancies->total();

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
        $auth = null;
        $check = Auth::guard('web')->check();
        if ($check) {
            $auth = User::where('id', Auth::guard('web')->id())->with('candidate')->first();
        }
        $checkStaff = Auth::guard('staff')->check();
        if ($checkStaff) {
            $auth = Staff::where('id', Auth::guard('staff')->id())->first();
        }
        return ['classificatory' => $classificatory, 'authUser' => $auth];
    }

    public function filter(VacancyFilters $filters)
    {
        try {
            // Build the query with filters and necessary relationships
            $query = Vacancy::filter($filters)
                            ->orderby('updated_at', 'DESC')
                            ->whereIn('status_id', [2, 6])
                            ->with([
                                'author',
                                'currency',
                                'category',
                                'workSchedule',
                                'vacancyForWhoNeed',
                                'vacancyBenefit',
                                'qualifyingCandidate',
                                'hr'
                            ]);

            // Use Laravel's built-in pagination and get the total count from the paginator
            $paginatedVacancies = $query->paginate(25);
            $vacancy = $paginatedVacancies->toArray();

            // The total count is obtained directly from the paginator
            $total = $paginatedVacancies->total();

            // Prepare the data for the response
            $data = [
                'vacancy' => $vacancy,
                'total' => $total
            ];

            return response()->json($data, 200);
        } catch (\Throwable $th) {
            // Handle exceptions and return an appropriate error response
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
        $vacancy = Vacancy::where('id', $id)
            ->with([
                'author',
                'currency',
                'category',
                'vacancyForWhoNeed',
                'hr',
                'workSchedule',
                'demand.education',
                'demand.specialty',
                'demand.language',
                'vacancyBenefit',
                'vacancyDuty',
                'qualifyingCandidate',
                'term',
                ])
            ->first();
        $isWebGuard = Auth::guard('web')->check();
        $auth = ($isWebGuard)?User::where('id', Auth::guard('web')->id())->with('candidate')->first():Auth::guard('staff')->user();
        $role_id = $auth?$auth->role_id:null;
        $findCandidate = ($isWebGuard && $role_id == 3)?QualifyingCandidate::where('vacancy_id', $vacancy->id)->where('candidate_id', Auth::guard('web')->user()->candidate->id)->first():null;
        $statusThisVacancy = ($findCandidate)?$findCandidate->qualifyingType:null;

        $data = ['vacancy' => $vacancy, 'statusThisVacancy' => $statusThisVacancy, 'applicants' => count($vacancy->vacancyInterest), 'auth' => $auth];
        if ($isWebGuard || $role_id == 3) {
            $vacancy->increment('view', 1);
        }

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
            ->with(['author','currency', 'category', 'workSchedule', 'vacancyForWhoNeed', 'vacancyBenefit', 'vacancyInterest', 'hr']);

            $vacancy = $query->paginate(25)->toArray();
            $total = $query->count();
            $data = [
                'vacancy' => $vacancy,
            ];
            $data = array_merge($data, $this->addData());
        return view('job_search', compact('data'));

    }




}

<?php

namespace App\Http\Controllers\Hr;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\NoReason;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\InterviewPlace;
use App\Models\QualifyingType;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Filters\Candidate\CandidateFilters;
use App\Services\AddVacancyPersonalService;
use App\Services\Admin\MoveEndDateService;

class SelectionPersonalController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private AddVacancyPersonalService $addVacancyPersonalService;
    private MoveEndDateService $moveEndDateService;
    public function __construct(ClassificatoryService $classificatoryService, AddVacancyPersonalService $addVacancyPersonalService,  MoveEndDateService $moveEndDateService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->addVacancyPersonalService = $addVacancyPersonalService;
        $this->moveEndDateService = $moveEndDateService;
    }
    public function index($id)  {
        // dd($id);
        $data = [];
        $vacancy = Vacancy::where('id', $id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit', 'getVacancyDrivingLicense.drivingLicense'

            ])->first();

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'maritalStatus', 'category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        return view('admin.selection_personal', compact('data'));
    }
    function vacancyPersonal($id) {

        $data = DB::table('qualifying_candidates as a')
            ->orderBy('qualifying_type_id', 'DESC')
            ->where('vacancy_id', $id)
            ->join('candidates as b', 'a.candidate_id', 'b.id')
            ->join('users as c', 'b.user_id', 'c.id')
            ->join('qualifying_types as d', 'a.qualifying_type_id', 'd.id')
            ->leftJoin('interview_places as e', 'a.interview_place_id', 'e.id')
            ->join('vacancies as v', 'a.vacancy_id', 'v.id')
            ->leftJoin('candidate_end_works as f', 'a.id', 'f.qualifying_candidate_id')
            ->select('a.*', 'b.id as candidate_id', 'c.name_ka as candidate_name',
            'd.name as qualifying_type', 'e.name_ka as interview_place',
            'v.status_id as vacancy_status_id', 'v.code as vacancy_code', 'v.start_date as vacancy_start_date',
            'v.interview_place_id as vacancy_interview_place_id', 'v.interview_date as vacancy_interview_date',
            'v.hr_id as vacancy_hr_id', 'f.no_reason_id as end_work_reason_id', 'f.reason_info as end_work_reason' )
            ->get();
        $auth = (Auth::user()->role_id == 1)?Auth::user():User::where('id', Auth::id())->with('hr')->first();
        // dd($data);
        return view('admin.vacancy_personal', compact('data', 'auth'));
    }

    public function find(CandidateFilters $filters)  {
        // dd($filters);
        return Candidate::filter($filters)
            ->whereIn('status_id', [9, 11, 14])
            ->with([
                'user', 'user.gender', 'specialty', 'nationality', 'religion', 'education', 'maritalStatus', 'citizenship',
                'professions', 'characteristic', 'getLanguage.language', 'getLanguage.level', 'allergy', 'drivingLicense', 'generalWorkExperience', 'notice',
                'familyWorkExperience.noReason','familyWorkExperience.familyWorkDuty', 'recommendation', 'getWorkInformation',
                'getWorkInformation.category','getWorkInformation.currency', 'getWorkInformation.workSchedule', 'qualifyingCandidate', 'qualifyingCandidate.vacancy', 'status'
            ])
            ->paginate(20)->toArray();
    }

    function addPersonalInfo(Request $request) {
        $findCandidate['this_vacancy'] = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])
            ->where('vacancy_id', $request->data['vacancy_id'])
            ->whereNull('status_id')
            ->with('qualifyingType')
            ->first();
        $busy = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])
            ->whereIn('qualifying_type_id', [ 4, 5, 7])
            ->whereNull('status_id')
            ->with(['qualifyingType', 'vacancy.hr.user'])
            ->get()->toArray();
        // ვპოულობ კანდიდატი თუ არის  'დამსაქმებლის მოწონებული', 'გამოსაცდელი ვადით', 'დასაქმდა' კატეგორიაში
        if (count($busy) == 0) {
            // თუ არ მოიძებნა ვაბრუნებ NULL
            $busy = null;
        }else{
            $vacancyIdToCheck = $request->data['vacancy_id'];
            // თუ მოიძებნა ვამოწმებ იძებნება თუ არა აუტორიზებული hr ვაკანსიებში თუ იძებნება NULL ვაბრუნებ თუ არ იძებნება ვამოწმებ მოთხოვნილ
            // ვაკანსიაზე უკვე ხომ არ არის დამატებული თუ არის NULL ვაბრუნებ თუ არა ვაბრუნებ ARRAY

            $collection = collect($busy);

            // ასევე ვამოწმებ ვაკანსიის სტატუს
            $filteredCollection = $collection->filter(function ($item, $key) {
                $statusId = $item['vacancy']['status_id'];
                return !in_array($statusId, [5, 6, 7]);
            });

            $filteredArray = $filteredCollection->all();
            // dd($collection);

            $coll = collect($filteredArray);

            $containsHrId = $coll->contains(function ($item, $key) {
                return  Auth::user()->role_id == 2 && $item['vacancy']['hr_id'] === Auth::user()->hr->id;
            });

            if ($containsHrId) {
                $busy = null;
                // ვფილტრავ ვაკანსიებს არჩეულის გარდა სადაც ეს კანდიდატები ავტორიზებულ ჰრ ყავს 'qualifying_type_id', [ 4, 5, 7] ამ ტიპში დამატებული
                $findVacancy = $coll->filter(function ($item, $key) use ($vacancyIdToCheck) {
                    return $item['vacancy']['id'] != $vacancyIdToCheck && $item['vacancy']['hr_id'] === Auth::user()->hr->id;
                });
                $findArray = $findVacancy->all();
                $findCandidate['another_vacancy'] = $findArray;
                // dd($findArray);
            }else{

                // Check if any element has an 'id' value equal to 2
                $containsVacancyId = $coll->contains(function ($item, $key) use ($vacancyIdToCheck) {
                    return  $item['vacancy_id'] === $vacancyIdToCheck;
                });

                if ($containsVacancyId) {
                    $busy = null;
                }else{
                    $busy = (count($filteredArray) > 0)?$filteredArray:null;
                }

            }


        }

        $classificatory = ['qualifyingType' => QualifyingType::all()->toArray(), 'interviewPlace' => InterviewPlace::all()->toArray()];
        $data = ['findCandidate' => $findCandidate, 'classificatory' => $classificatory, 'busy' => $busy];
        return response()->json($data);
    }

    function addPersonal(Request $request) {
        $data = $request->data;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->addVacancyPersonalService->addPersonal($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function updatePersonal(Request $request)  {
        $data = $request->data;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->addVacancyPersonalService->updatePersonal($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function updateEndDate(Request $request) {
        $data = $request->model;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->moveEndDateService->move($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function deletePersonal(Request $request) {
        $data = $request->data;
        // dd($data);
        $result = ['status' => 200];

        try {
            $result['data'] = $this->addVacancyPersonalService->deletePersonal($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    function addPersonalWasEmployed(Request $request) {
        $data = $request->data;
        // dd($data);
        $result = ['status' => 200];

        try {
            $result['data'] = $this->addVacancyPersonalService->addPersonalWasEmployed($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function getEndWorkInfo()  {
        $data = NoReason::where('category', 4)->whereNot('id', 16)->get()->toArray();
        return response()->json($data);
    }

    function getScheduleInfo(Request $request)  {
        $data = $request->data;
        $result = [];
        if ($data['candidate_id']) {
            $find = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('qualifying_type_id', 7)->whereNull('status_id')->first();
        }else{
            $find = QualifyingCandidate::Where('id', $data['id'])->whereNull('status_id')->first();
        }

        $vacancy = Vacancy::where('id', $find->vacancy_id)
            ->with('workSchedule')
            ->select('additional_schedule_ka', 'work_schedule_id', 'code')
            ->first()
            ->toArray();
        $result['vacancy'] = $vacancy;
        $result['schedule'] = $find->workDay;
        // dd($find->workDay);
        return response()->json($result);
    }

    function getWorkDayInfo(Request $request)  {
        // ვამოწმებ კანდიდატი თუ არის უკვე დროებით დასაქმებული ვაბრუნებ TRUE,
        // ვამოწმებ დასაქმების დღეებს
        // ჯეისონიდან ამოღებული პირველი 6 თარიღით ვიგებ დღეების სახელებს
        // ვაბრუნებ მასივად
        $find = QualifyingCandidate::where('candidate_id', $request->candidate_id )
            ->where('qualifying_type_id', 7)
            ->where('end_date', '>', Carbon::today())
            ->with('workDay')
            ->get()->toArray();
        $dayArr = [];
        if (count($find)) {

            foreach ($find as $key => $value) {
                $decode = json_decode($value['work_day']['work_day']);
                $newArray = array_splice($decode, 0, 6);
                $dayArr = array_unique(array_merge($dayArr, collect($newArray)->map(fn($o) => Carbon::parse($o)->format('l'))->toArray()));
                // dd($dayArr);
            }

        }
        // dd($find);
        // $data = [];
        return response()->json($dayArr);
    }


    function getAddPersonalWasEmployedInfo(Request $request)  {
        // dd($request->data);
        $data['candidates'] = QualifyingCandidate::where('vacancy_id', $request->data)->with(['candidate.user', 'qualifyingType'])->get();
        $data['employ_type'] = QualifyingType::whereIN('id', [6, 7])->get()->toArray();
        return response()->json($data);
    }


}

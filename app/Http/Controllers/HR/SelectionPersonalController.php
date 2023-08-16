<?php

namespace App\Http\Controllers\Hr;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\gender;
use App\Models\Status;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\NoReason;
use App\Models\Candidate;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Models\InterviewPlace;
use App\Models\QualifyingType;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\EndWorkService;
use App\Services\ClassificatoryService;
use App\Filters\Candidate\CandidateFilters;
use App\Services\AddVacancyPersonalService;

class SelectionPersonalController extends Controller
{
    private ClassificatoryService $classificatoryService;
    private AddVacancyPersonalService $addVacancyPersonalService;
    private EndWorkService $endWorkService;
    public function __construct(ClassificatoryService $classificatoryService, AddVacancyPersonalService $addVacancyPersonalService, EndWorkService $endWorkService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->addVacancyPersonalService = $addVacancyPersonalService;
        $this->endWorkService = $endWorkService;
    }
    public function index($id)  {
        // dd($id);
        $data = [];
        $vacancy = Vacancy::where('id', $id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit'

            ])->first();

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'maritalStatus', 'category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        return view('hr.selection_personal', compact('data'));
    }
    function vacancyPersonal($id) {

        $data = QualifyingCandidate::orderBy('qualifying_type_id', 'DESC')->where('vacancy_id', $id)->with([
            'candidate.getWorkInformation.category','candidate.status', 'candidate.user', 'qualifyingType','vacancy'
        ])->paginate(25);
        $classificatory = [
            'category' => Category::all()->toArray(),
            'status' => Status::where('status_type_id', 1)->get()->toArray(),
            'qualifyingType' => QualifyingType::all()->toArray(),
            'auth' => (Auth::user()->role_id == 1)?Auth::user():User::where('id', Auth::id())->with('hr')->first()
        ];
        // dd($data);
        return view('hr.vacancy_personal', compact('data', 'classificatory'));
    }

    public function find(CandidateFilters $filters)  {
        // dd($filters);
        $candidate = Candidate::filter($filters)->whereNot('status_id', 12)->with([
            'user', 'user.gender', 'specialty', 'nationality', 'religion', 'education', 'maritalStatus', 'citizenship',
            'professions', 'characteristic', 'getLanguage.language', 'getLanguage.level', 'allergy', 'drivingLicense', 'generalWorkExperience', 'notice',
            'familyWorkExperience.noReason','familyWorkExperience.familyWorkDuty', 'recommendation', 'getWorkInformation',
            'getWorkInformation.category','getWorkInformation.currency', 'getWorkInformation.workSchedule', 'qualifyingCandidate', 'qualifyingCandidate.vacancy', 'status'
        ])->get();
        // dd($candidate);
        return $candidate;
    }

    function addPersonalInfo(Request $request) {
        $findCandidate['this_vacancy'] = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])->where('vacancy_id', $request->data['vacancy_id'])->with('qualifyingType')->first();
        $busy = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])->whereIn('qualifying_type_id', [ 4, 5, 7])->with(['qualifyingType', 'vacancy.hr.user'])->get()->toArray();
        // ვპოულობ კანდიდატი თუ არის  'დამსაქმებლის მოწონებული', 'გამოსაცდელი ვადით', 'დასაქმდა' კატეგორიაში
        if (count($busy) == 0) {
            // თუ არ მოიძებნა ვაბრუნებ NULL
            $busy = null;
        }else{
            $vacancyIdToCheck = $request->data['vacancy_id'];
            // თუ მოიძებნა ვამოწმებ იძებნება თუ არა აუტორიზებული hr ვაკანსიებში თუ იძებნება NULL ვაბრუნებ თუ არ იძებნება ვამოწმებ მოთხოვნილ
            // ვაკანსიაზე უკვე ხომ არ არის დამტებული თუ არის NULL ვაბრუნებ თუ არა ვაბრუნებ ARRAY

            $collection = collect($busy);

            // ასევე ვამოწმებ ვაკანსიის სტატუს
            $filteredCollection = $collection->filter(function ($item, $key) {
                $statusId = $item['vacancy']['status_id'];
                return !in_array($statusId, [5, 6, 7]);
            });

            $filteredArray = $filteredCollection->all();


            $coll = collect($filteredArray);

            $containsHrId = $coll->contains(function ($item, $key) {
                return  $item['vacancy']['hr_id'] === Auth::user()->hr->id;
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
                    $busy = $filteredArray;
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
            $result['data'] = QualifyingCandidate::where('id', $data['id'])->update(['end_date' => $data['end_date']]);
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
        // dd($request->data);
        $data = [];
        $find = QualifyingCandidate::where('id', $request->data)->first();
        $vacancy = Vacancy::where('id', $find->vacancy_id)->with('workSchedule')->select('additional_schedule_ka', 'work_schedule_id', 'code')->first()->toArray();
        $data['vacancy'] = $vacancy;
        $data['schedule'] = $find->workDay;
        // dd($find->workDay);
        return response()->json($data);
    }


}

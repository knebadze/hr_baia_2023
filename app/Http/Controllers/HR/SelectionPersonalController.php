<?php

namespace App\Http\Controllers\HR;

use Exception;
use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\NoReason;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\InterviewPlace;
use App\Models\QualifyingType;
use App\Models\QualifyingCandidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Services\Admin\MoveEndDateService;
use App\Filters\Candidate\CandidateFilters;
use App\Services\AddVacancyPersonalService;
use App\Traits\HandlesAdminDataViewCaching;
use App\Http\Resources\QualifyingCandidateResource;

class SelectionPersonalController extends Controller
{
    use  HandlesAdminDataViewCaching;
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
        $data = [];
        $vacancy = Vacancy::where('id', $id)->with([
            'vacancyDuty', 'vacancyBenefit', 'vacancyForWhoNeed', 'characteristic', 'employer', 'currency','category', 'status',
            'workSchedule', 'vacancyInterest', 'interviewPlace','term', 'demand', 'demand.language', 'demand.education', 'demand.languageLevel','demand.specialty',
            'employer.numberCode','deposit', 'getVacancyDrivingLicense.drivingLicense',

            ])->first();

        $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
        'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
        'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'maritalStatus', 'category', 'workSchedule'];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $data = ['vacancy'=> $vacancy, 'classificatory' => $classificatory];
        return view('admin.selection_personal', compact('data'));
    }
    function vacancyPersonal($id) {

        $qualifyingCandidates = QualifyingCandidate::with([
            'candidate.user',
            'qualifyingType',
            'interviewPlace',
            'vacancy',
            'endWork',
            'status'
        ])
        ->where('vacancy_id', $id)
        ->orderBy('qualifying_type_id', 'DESC')
        ->get();
        $data['store'] = QualifyingCandidateResource::collection($qualifyingCandidates);
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $role_id = $auth->role_id;

        // Simplified conditional logic
        $adminViewAndPermission = [];
        if ($role_id == 1) {
            $adminViewAndPermission = $this->getAdminDataViewByKeyAndUserId('VacancyPersonal');
        }
        $data['adminViewAndPermission'] = $adminViewAndPermission;
        return view('admin.vacancy_personal', compact('data', 'auth'));
    }

    public function find(CandidateFilters $filters)  {
        $query = Candidate::filter($filters)
            ->whereIn('status_id', [9, 11, 14, 15])
            ->with([
                'user.gender',
                'user.registerLog',
                'user.registerFee',
                'getWorkInformation.category',
                'getWorkInformation.currency',
                'getWorkInformation.getWorkSchedule.workSchedule',
                'nationality',
                'citizenship',
                'religion',
                'education',
                'getLanguage.language',
                'getLanguage.level',
                'professions',
                'specialty',
                'recommendation',
                'generalWorkExperience',
                'familyWorkExperience.noReason',
                'familyWorkExperience.familyWorkDuty',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense',
                'status',
                'number.numberOwner',
                'qualifyingCandidate'
            ]);
        $total = $query->count();
        $candidates = $query->paginate(20)->toArray();
        return [
            'candidates' => $candidates,
            'total' => $total
        ];
    }

    function addPersonalInfo(Request $request) {
        $findCandidate['this_vacancy'] = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])
            ->where('vacancy_id', $request->data['vacancy_id'])
            // ->where(function ($query) {
            //     $query->whereNull('status_id')
            //         ->orWhere('status_id', 17);
            // })
            ->with('qualifyingType')
            ->first();
        $busy = QualifyingCandidate::where('candidate_id', $request->data['candidate_id'])
            ->whereIn('qualifying_type_id', [ 4, 5, 6, 7, 8])
            ->where(function ($query) {
                $query->whereNull('status_id')
                    ->orWhere('status_id', 17);
            })
            ->with(['qualifyingType', 'vacancy.hr'])
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
                return !in_array($statusId, [5, 6, 7, 8]);
            });

            $filteredArray = $filteredCollection->all();

            $coll = collect($filteredArray);

            $containsHrId = $coll->contains(function ($item, $key) {
                return  Auth::guard('staff')->user()->role_id == 2 && $item['vacancy']['hr_id'] === Auth::guard('staff')->user()->id;
            });

            if ($containsHrId) {
                $busy = null;
                // ვფილტრავ ვაკანსიებს არჩეულის გარდა სადაც ეს კანდიდატები ავტორიზებულ ჰრ ყავს 'qualifying_type_id', [ 4, 5, 7] ამ ტიპში დამატებული
                $findVacancy = $coll->filter(function ($item, $key) use ($vacancyIdToCheck) {
                    return $item['vacancy']['id'] != $vacancyIdToCheck && $item['vacancy']['hr_id'] === Auth::guard('staff')->user()->id;
                });
                $findArray = $findVacancy->all();
                $findCandidate['another_vacancy'] = $findArray;
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
        $data = ['candidateInfo' => $findCandidate, 'cla' => $classificatory, 'busy' => $busy];
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
            $find = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('qualifying_type_id', 8)->whereNull('status_id')->first();
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
        return response()->json($result);
    }

    function getWorkDayInfo(Request $request)  {
        // ვამოწმებ კანდიდატი თუ არის უკვე დროებით დასაქმებული ვაბრუნებ TRUE,
        // ვამოწმებ დასაქმების დღეებს
        // ჯეისონიდან ამოღებული პირველი 6 თარიღით ვიგებ დღეების სახელებს
        // ვაბრუნებ მასივად
        $find = QualifyingCandidate::where('candidate_id', $request->candidate_id )
            ->where('qualifying_type_id', 8)
            ->where('end_date', '>', Carbon::today())
            ->with('workDay')
            ->get()->toArray();
        $dayArr = [];
        if (count($find)) {

            foreach ($find as $key => $value) {
                $decode = json_decode($value['work_day']['work_day']);
                $newArray = array_splice($decode, 0, 6);
                $dayArr = array_unique(array_merge($dayArr, collect($newArray)->map(fn($o) => Carbon::parse($o)->format('l'))->toArray()));
            }

        }
        return response()->json($dayArr);
    }


    function getAddPersonalWasEmployedInfo(Request $request)  {
        $data['candidates'] = QualifyingCandidate::where('vacancy_id', $request->data)->with(['candidate.user', 'qualifyingType', 'status'])->get();
        $data['employ_type'] = QualifyingType::whereIN('id', [7, 8])->get()->toArray();
        return response()->json($data);
    }


}

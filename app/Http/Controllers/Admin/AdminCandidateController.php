<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ClassificatoryService;
use App\Filters\Candidate\CandidateFilters;
use App\Models\Additional_number;
use App\Services\Admin\CandidateUpdateService;
use App\Services\SmsService;

class AdminCandidateController extends Controller
{

    private ClassificatoryService $classificatoryService;
    private CandidateUpdateService $candidateUpdateService;
    public function __construct(ClassificatoryService $classificatoryService, CandidateUpdateService $candidateUpdateService)
    {
        $this->classificatoryService = $classificatoryService;
        $this->candidateUpdateService = $candidateUpdateService;
    }
    public function index()
    {


                $candidateClassificatoryArr = [
                    'gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
                    'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences',  'drivingLicense','characteristic',
                    'yesNo', 'category', 'workSchedule', 'candidateStatus', 'candidateStatus'
                ];
                $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);
                $data = [
                    'classificatory' => $classificatory,
                    'auth' => Auth::user()
                ];
        return view('admin.candidate', compact('data'));
    }

    function fetch(Request $request)  {
        try {
            // $perPage = $request->input('per_page', 20);
            $data = Candidate::orderBy('id', 'DESC')->with(
                [
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

                ])->paginate(20)->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json($data);
    }

    public function filter(CandidateFilters $filters)
    {
        return Candidate::filter($filters)->orderBy('id', 'DESC')->with(
            [
                'user.gender',
                'user.registerLog',
                // 'workInformation',
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
            ])->paginate(20)->toArray();
    }

    public function workInfoData(Request $request)
    {
        $workInformation = WorkInformation::where('candidate_id', $request->id)->where('category_id', $request->category_id)->with('workSchedule', 'currency')->first();
        return response($workInformation);
    }

    public function familyWorkInfoData(Request $request)
    {
        $data = DB::table('candidate_family_work_skills as a')->where('a.candidate_id', $request->id)
        ->join('skills as b', 'a.skill_id', 'b.id')
        ->join('categories as c', 'b.category_id', 'c.id')
        ->select('b.name_ka as skill', 'c.name_ka as category')
        ->get();
        return response($data);
    }

    function edit($id) {
        // dd($id);
        $candidate = Candidate::where('id', $id)->with(
            [
                'user.gender',
                'getWorkInformation.category',
                'getWorkInformation.currency',
                'getWorkInformation.getWorkSchedule.workSchedule',
                'getWorkInformation.workSchedule',
                'nationality',
                'citizenship',
                'religion',
                'education',
                'getLanguage.language',
                'getLanguage.level',
                'professions',
                'specialty',
                'getRecommendation.hasRecommendation',
                'getRecommendation.recommendationWhom',
                'getRecommendation.numberCode',
                'getRecommendation.noReason',
                'getGeneralWorkExperience.workExperience',
                'getGeneralWorkExperience.hasExperience',
                'familyWorkExperience.hasExperience',
                'familyWorkExperience.noReason',
                'familyWorkExperience.familyWorkDuty',
                'familyWorkExperience.familyWorkCategory',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense',
                'number.numberOwner',
                'number.numberCode',
                'getNotice.notice'
            ])->first()->toArray();

        $classificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
            'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences', 'notices', 'noExperienceReason', 'drivingLicense',
            'numberCode', 'characteristic', 'numberOwner', 'yesNo', 'workSchedule', 'category', 'currency', 'duty','recommendationFromWhom', 'noRecommendationReason'];
        $classificatory = $this->classificatoryService->get($classificatoryArr);
        $data = ['candidate' => $candidate, 'classificatory' => $classificatory];
        return view('admin.candidate_update', compact('data'));
    }

    function update(Request $request){
        $result = ['status' => 200];

        try {
            $result = $this->candidateUpdateService->update($request->data);
            $result['status'] = 200;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    function delete(Request $request)  {
        // dd($request->id);
        $result = ['status' => 200];

        try {
            Candidate::where('id', $request->id)->delete();
            $result['status'] = 200;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result['status']);
    }
    function addCandidate() {
        $data = [];

        $auth = Auth::user();
        $user = User::where('id', $auth->id)->with('gender')->first();

        //კლასიფიკატორები

        $candidateClassificatoryArr = ['gender'];
        $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);

        $data = [
            'classificatory' => $classificatory
        ];
        return view('admin.add_candidate', compact('data'));
    }

    function additionalNumberInfo(Request $request)  {

        $data = Additional_number::where('candidate_id', $request->data)->with(['numberOwner', 'numberCode'])->get()->toArray();
        return response()->json($data);
    }

    function getFullInfo(Request $request)  {
        // dd($request->all());
        $candidate = Candidate::where('id', $request->data)->with(
            [
                'user.gender',
                'user.registerLog',
                'user.registerFee',
                // 'workInformation',
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
            ])->first()->toArray();
            $data = [
                'candidate' => $candidate,
                'role_id' => Auth::user()->role_id,
                'hr_id' => Auth::id(),
            ];
        return response()->json($data);
    }

    function sendSms(Request $request) {
        try {
            $smsService = new SmsService();
            $result = $smsService->sendSms($request->number, $request->text);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }
}

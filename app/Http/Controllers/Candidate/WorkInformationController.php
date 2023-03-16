<?php

namespace App\Http\Controllers\Candidate;


use Exception;
use App\Models\User;
use App\Models\Skill;
use App\Models\Category;
use App\Models\Currency;
use App\Models\NoReason;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use App\Models\Work_experience;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\RecommendationFromWhom;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;
use App\Models\CandidateFamilyWorkSkill;
use App\Models\WorkInformationWorkSchedule;
use App\Models\YesNo;
use App\Services\WorkInformationService;
use App\Services\FAmilyWorkExperienceService;

class WorkInformationController extends Controller
{
    private WorkInformationService $workInformationService;
    private FamilyWorkExperienceService $familyWorkExperience;
    public function __construct(WorkInformationService $workInformationService, FamilyWorkExperienceService $familyWorkExperience)
    {
        $this->workInformationService = $workInformationService;
        $this->familyWorkExperience = $familyWorkExperience;
    }
    public function index(){
        $data = [];
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();

        if (DB::table('work_information')->where('candidate_id', $user->candidate->id)->exists()) {
            $workInformation = WorkInformation::where('candidate_id', $user->candidate->id)->with(['category', 'workSchedule','currency', 'noFamilyWorkExperience'])->get()->toArray();
            $getWorkInformation =  Schema::getColumnListing('work_information');
            $getWorkInformation = array_map(function ($item) { return ""; }, array_flip($getWorkInformation));
        }else{
            $workInformation = [];
            $getWorkInformation =  Schema::getColumnListing('work_information');
            $getWorkInformation = array_map(function ($item) { return ""; }, array_flip($getWorkInformation));
        }

        if (DB::table('work_information')->where('candidate_id', $user->candidate->id)->exists() && DB::table('candidate_recommendations')->where('candidate_id', $user->candidate->id)->exists()) {
            $candidateRecommendation = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with('recommendationWhom')->with('noReason')->with('hasRecommendation')->get();
        }else{
            $candidateRecommendation = [];
        }

        // if (DB::table('work_information')->where('candidate_id', $user->candidate->id)->exists() && DB::table('no_family_work_experiences')->where('work_information_id', $workInformation[0]->id)->exists()) {
        //     $noFamilyWorkInformation = WorkInformationWorkSchedule::where('work_information_id', $workInformation->id)->get();
        // }else{
        //     $noFamilyWorkInformation = [];
        // }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_family_work_skills')->where('candidate_id', $user->candidate->id)->exists()) {

            $candidateFamilyWorkSkill = DB::table('candidate_family_work_skills')->where('candidate_id', $user->candidate->id)
                            ->join('skills', 'candidate_family_work_skills.skill_id', 'skills.id')->get();
            foreach ($candidateFamilyWorkSkill as $key => $value) {
                $familyWorkedSelectedArr[] = $value->category_id;
            }

            $familyWorkedSelected = Category::whereIn('id', $familyWorkedSelectedArr)->get();
        }else{
            $familyWorkedSelected = [];
            $candidateFamilyWorkSkill = [];
        }

        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('family_work_experiences')->where('candidate_id', $user->candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $user->candidate->id)->with('workExperience')->with('longest')->with('noReason')->with('hasExperience')->first()->toArray();
        }else{
            $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
            $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
        }

        //classificator
        $category = Category::all()->toArray();
        $familyCategory = Category::where('type', 1)->get()->toArray();
        $workSchedule = WorkSchedule::all()->toArray();
        $workExperience = Work_experience::all()->toArray();
        $currency = Currency::all()->toArray();
        $recommendationFromWhom = RecommendationFromWhom::all()->toArray();
        $noRecommendationReason = NoReason::where('category', 2)->get()->toArray();
        $skill = Skill::all()->toArray();
        $noExperienceReason = NoReason::where('category', 1)->get()->toArray();
        $yesNo = YesNo::all()->toArray();

        // dd($workInformation);
        $data = [
            'auth', $auth,
            'model' => [
                'workInformation' => $workInformation,
                'getWorkInformation' => $getWorkInformation,
                'candidateRecommendation' => $candidateRecommendation,
                'candidateFamilyWorkSkill' => $candidateFamilyWorkSkill,
                'familyWorkExperience' => $familyWorkExperience,
                'familyWorkedSelected' => $familyWorkedSelected,
                // 'workInformationSchedule' => $workInformationSchedule
            ],
            'classificator' => [
                'category' => $category,
                'familyCategory' => $familyCategory,
                'workSchedule' => $workSchedule,
                'workExperience' => $workExperience,
                'currency' => $currency,
                'recommendationFromWhom' => $recommendationFromWhom,
                'skill' => $skill,
                'noRecommendationReason' => $noRecommendationReason,
                'noExperienceReason' => $noExperienceReason,
                'yesNo' => $yesNo,
            ],

        ];

        return view('user.work_information', compact('data'));
    }
    public function store(Request $request){
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function updateWorkInformation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function deleteWorkInformation(Request $request)
    {
        WorkInformation::find($request->id)->delete();
        return response()->json('');
    }

    public function familyStore(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->familyWorkExperience->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function addRecommendation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function addRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->saveRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function removeRecommendation(Request $request)
    {
        $recommendation = CandidateRecommendation::find($request->id);
        if ($recommendation->file) {
            File::delete(public_path('user-documentation/'.$recommendation->file));
        }
        $recommendation->delete();
        return response()->json();
    }
    public function trashRecommendation(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->trashRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    public function removeRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->removeRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    public function updateRecommendation(Request $request)
    {

        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    public function updateRecommendationFile(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationService->updateRecommendationFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}

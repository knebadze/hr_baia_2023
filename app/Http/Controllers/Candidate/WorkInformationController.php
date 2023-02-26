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
use App\Models\RecommendationFromWhom;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;
use App\Services\WorkInformationService;

class WorkInformationController extends Controller
{
    private WorkInformationService $workInformationRepository;
    public function __construct(WorkInformationService $workInformationRepository)
    {
        $this->workInformationRepository = $workInformationRepository;
    }
    public function index(){
        $data = [];
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        // dd($user->candidate->id);
        // exit;
        if (DB::table('work_information')->where('candidate_id', $user->candidate->id)->exists()) {
            $workInformation = WorkInformation::where('candidate_id', $user->candidate->id)->first();
            // dd($candidate);
        }else{
            $workInformation = [];
        }
        $getWorkInformation =  Schema::getColumnListing('work_information');
        $getWorkInformation = array_map(function ($item) { return ""; }, array_flip($getWorkInformation));
        // dd($getWorkInformation);
            // $workInformation = [];
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_recommendations')->where('candidate_id', $user->candidate->id)->exists()) {
            $candidateRecommendation = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with('recommendationWhom')->first();
        }else{
            // $candidateRecommendation = Schema::getColumnListing('candidate_recommendations');
            // $candidateRecommendation = [array_map(function ($item) {  return ""; }, array_flip($candidateRecommendation))];
            $candidateRecommendation = [];
        }
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('candidate_family_work_skills')->where('candidate_id', $user->candidate->id)->exists()) {
            $candidateFamilyWorkSkill = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with('recommendationWhom')->get()->toArray();
        }else{
            // $candidateFamilyWorkSkill = Schema::getColumnListing('candidate_family_work_skills');
            // $candidateFamilyWorkSkill = array_map(function ($item) {  return ""; }, array_flip($candidateFamilyWorkSkill));
            $candidateFamilyWorkSkill = [];
        }
        if (DB::table('candidates')->where('user_id', $auth->id)->exists() && DB::table('family_work_experiences')->where('candidate_id', $user->candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $user->candidate->id)->get()->toArray();
        }else{
            $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
            $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
            // $familyWorkExperience = [];
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

        // dd($workInformation);
        $data = [
            'auth', $auth,
            'model' => [
                'getWorkInformation' => $getWorkInformation,
                'candidateRecommendation' => $candidateRecommendation,
                'candidateFamilyWorkSkill' => $candidateFamilyWorkSkill,
                'familyWorkExperience' => $familyWorkExperience
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
                'noExperienceReason' => $noExperienceReason
            ],

        ];

        return view('user.work_information', compact('data'));
    }
    public function store(Request $request){
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->workInformationRepository->saveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\WorkInformation;
use App\Filters\Candidate\CandidateFilters;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ClassificatoryService;
use App\Models\CandidateFamilyWorkSkill;

class AdminCandidateController extends Controller
{

    private ClassificatoryService $classificatoryService;
    // private ModelService $modelService;
    public function __construct(ClassificatoryService $classificatoryService)
    {
        $this->classificatoryService = $classificatoryService;
        // $this->modelService = $modelService;
    }
    public function index()
    {
            $candidate = Candidate::orderBy('id', 'DESC')->with(
                [
                    'user.gender',
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
                    'familyWorkExperience',
                    'characteristic',
                    'allergy',
                    'maritalStatus',
                    'drivingLicense'
                ])->paginate(50)->toArray();

                $candidateClassificatoryArr = ['gender', 'nationality', 'religions','educations', 'maritalStatus', 'citizenship', 'professions',
                'specialties', 'allergies', 'languages', 'languageLevels', 'workExperiences',  'drivingLicense','characteristic',  'yesNo', 'category', 'workSchedule'];
                $classificatory = $this->classificatoryService->get($candidateClassificatoryArr);
                $data = [
                    'candidate' => $candidate,
                    'classificatory' => $classificatory,
                ];
        return view('admin.candidate', compact('data'));
    }


    public function filter(CandidateFilters $filters)
    {
        return Candidate::filter($filters)->orderBy('id', 'DESC')->with(
            [
                'user.gender',
                'workInformation',
                'nationality',
                'citizenship',
                'religion',
                'education',
                'languages',
                'professions',
                'specialty',
                'recommendation',
                'generalWorkExperience',
                'familyWorkExperience',
                'characteristic',
                'allergy',
                'maritalStatus',
                'drivingLicense'
            ])->paginate(50)->toArray();;
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
}

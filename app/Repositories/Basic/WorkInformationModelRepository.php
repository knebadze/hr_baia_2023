<?php

namespace App\Repositories\Basic;

use App\Models\User;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\WorkInformation;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;
use App\Models\CandidateFamilyWorkSkill;

class WorkInformationModelRepository
{
    public function model($auth_id)
    {
        $user = User::where('id', $auth_id)->first();
        if (WorkInformation::where('candidate_id', $user->candidate->id)->exists()) {
            $workInformation = WorkInformation::where('candidate_id', $user->candidate->id)->with(['category', 'workSchedule','currency'])->get()->toArray();
            $getWorkInformation =  Schema::getColumnListing('work_information');
            $getWorkInformation = array_map(function ($item) { return ""; }, array_flip($getWorkInformation));
        }else{
            $workInformation = [];
            $getWorkInformation =  Schema::getColumnListing('work_information');
            $getWorkInformation = array_map(function ($item) { return ""; }, array_flip($getWorkInformation));
        }

        if (WorkInformation::where('candidate_id', $user->candidate->id)->exists() && CandidateRecommendation::where('candidate_id', $user->candidate->id)->exists()) {
            $candidateRecommendation = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])->get();
        }else{
            $candidateRecommendation = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && CandidateFamilyWorkSkill::where('candidate_id', $user->candidate->id)->exists()) {

            $candidateFamilyWorkSkill = CandidateFamilyWorkSkill::where('candidate_id', $user->candidate->id)
                            ->join('skills', 'candidate_family_work_skills.skill_id', 'skills.id')->get();
            foreach ($candidateFamilyWorkSkill as $key => $value) {
                $familyWorkedSelectedArr[] = $value->category_id;
            }

            $familyWorkedSelected = Category::whereIn('id', $familyWorkedSelectedArr)->get();
        }else{
            $familyWorkedSelected = [];
            $candidateFamilyWorkSkill = [];
        }

        if (Candidate::where('user_id', $auth_id)->exists() && FamilyWorkExperience::where('candidate_id', $user->candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $user->candidate->id)->with('workExperience')->with('longest')->with('noReason')->with('hasExperience')->first()->toArray();
        }else{
            $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
            $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
        }

        $date = [
            'workInformation' => $workInformation,
            'getWorkInformation' => $getWorkInformation,
            'candidateRecommendation' => $candidateRecommendation,
            'candidateFamilyWorkSkill' => $candidateFamilyWorkSkill,
            'familyWorkExperience' => $familyWorkExperience,
            'familyWorkedSelected' => $familyWorkedSelected,
        ];
        return $date;
    }
}

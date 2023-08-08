<?php

namespace App\Repositories\Basic;

use App\Models\User;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\WorkInformation;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Schema;
use App\Models\CandidateRecommendation;

class WorkInformationModelRepository
{
    public function model($auth_id)
    {
        $user = User::where('id', $auth_id)->first();
        if (WorkInformation::where('candidate_id', $user->candidate->id)->exists()) {
            $getWorkInformation = WorkInformation::where('candidate_id', $user->candidate->id)->with(['category', 'workSchedule','currency'])->get()->toArray();
            $workInformation =  Schema::getColumnListing('work_information');
            $workInformation = array_map(function ($item) { return ""; }, array_flip($workInformation));
            $workInformation['category'] = '';
            $workInformation['currency'] = '';
            $workInformation['work_schedule'] = '';
        }else{
            $getWorkInformation = [];
            $workInformation =  Schema::getColumnListing('work_information');
            $workInformation = array_map(function ($item) { return ""; }, array_flip($workInformation));
            $workInformation['category'] = '';
            $workInformation['currency'] = '';
            $workInformation['work_schedule'] = '';
        }

        if (WorkInformation::where('candidate_id', $user->candidate->id)->exists() && CandidateRecommendation::where('candidate_id', $user->candidate->id)->exists()) {
            $candidateRecommendation = CandidateRecommendation::where('candidate_id', $user->candidate->id)->with(['recommendationWhom', 'numberCode', 'noReason', 'hasRecommendation'])->get();
            $recommendation = Schema::getColumnListing('candidate_recommendations');
            $recommendation = array_map(function ($item) {  return ""; }, array_flip($recommendation));
            $recommendation['recommendation_whom'] = '';
            $recommendation['number_code'] = '';
            $recommendation['no_reason'] = '';
            $recommendation['has_recommendation'] = '';
        }else{
            $candidateRecommendation = [];
            $recommendation = Schema::getColumnListing('candidate_recommendations');
            $recommendation = array_map(function ($item) {  return ""; }, array_flip($recommendation));
            $recommendation['recommendation_whom'] = '';
            $recommendation['number_code'] = '';
            $recommendation['no_reason'] = '';
            $recommendation['has_recommendation'] = '';
        }


        if (Candidate::where('user_id', $auth_id)->exists() && FamilyWorkExperience::where('candidate_id', $user->candidate->id)->exists()) {
            $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $user->candidate->id)->with(['workExperience', 'longest', 'noReason', 'hasExperience', 'familyWorkDuty', 'familyWorkCategory'])->first()->toArray();
        }else{
            $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
            $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
            $familyWorkExperience['work_experience'] = '';
            $familyWorkExperience['longest'] = '';
            $familyWorkExperience['no_reason'] = '';
            $familyWorkExperience['has_experience'] = '';
            $familyWorkExperience['family_work_duty'] = '';
            $familyWorkExperience['family_work_category'] = '';
        }

        $date = [
            'workInformation' => $workInformation,
            'getWorkInformation' => $getWorkInformation,
            'candidateRecommendation' => $candidateRecommendation,
            'recommendation' => $recommendation,
            'familyWorkExperience' => $familyWorkExperience,
        ];
        return $date;
    }
}

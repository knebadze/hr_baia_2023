<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use App\Models\FamilyWorkExperience;
use Illuminate\Support\Facades\Schema;

class CandidateFamilyWorkExperience
{
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $familyWorkExperience = FamilyWorkExperience::where('candidate_id', $candidate->id)
            ->with(['workExperience', 'longest', 'noReason', 'hasExperience', 'familyWorkDuty', 'familyWorkCategory'])
            ->first();
            // ->toArray();

        if(!$familyWorkExperience){
            $familyWorkExperience = Schema::getColumnListing('family_work_experiences');
            $familyWorkExperience = array_map(function ($item) {  return ""; }, array_flip($familyWorkExperience));
            $familyWorkExperience['work_experience'] = '';
            $familyWorkExperience['longest'] = '';
            $familyWorkExperience['no_reason'] = '';
            $familyWorkExperience['has_experience'] = '';
            $familyWorkExperience['family_work_duty'] = '';
            $familyWorkExperience['family_work_category'] = '';
        }

        return [ 'familyWorkExperience' => $familyWorkExperience, 'candidate_id' => $candidate->id ];

    }
}

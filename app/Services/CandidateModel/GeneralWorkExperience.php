<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use App\Models\General_work_experience;

class GeneralWorkExperience
{
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $candidateWorkExperience = General_work_experience::where('candidate_id', $candidate->id)
            ->with(['workExperience', 'noReason', 'hasExperience'])
            ->get()
            ->toArray();
        if(!$candidateWorkExperience){
            $candidateWorkExperience = [];
        }
        return  ['candidateWorkExperience' => $candidateWorkExperience];
        // ['user_id' => $candidate['user_id'], 'candidateWorkExperience' => $candidateWorkExperience];
    }
}

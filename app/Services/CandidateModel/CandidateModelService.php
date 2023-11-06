<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class CandidateModelService
{
    protected $filters = [
        '0' => MainInfo::class,
        '1' => CandidateInformation::class,
        '2' => Address::class,
        '3' => Language::class,
        '4' => AdditionalNumber::class,
        '5' => GeneralWorkExperience::class,
        '6' => CandidateWorkInformation::class,
        '7' => CandidateFamilyWorkExperience::class,
        '8' => Recommendation::class,
        '9' => Notice::class,

    ];
    function findData($setStage = null, $user_id = null, $candidate_id = null) {
        $userId = $user_id ? $user_id : Auth::id();
        $stage = $setStage !== null ? $setStage : $this->checkStage($userId);
        $filterInstance = new $this->filters[$stage];

        $result =  $filterInstance($userId, $candidate_id);
        $result['stage'] = $stage;
        $result['user_id'] = $userId;
        return $result;
    }

    function checkStage($user_id) {
        // dd('hello');
        $stage = 0;
        if(Candidate::where('user_id', $user_id)->exists()){
            $candidate = Candidate::where('user_id', $user_id)->first();
            $stage = $candidate->stage;
        }
        return $stage;
    }
}

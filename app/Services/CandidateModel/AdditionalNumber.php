<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use App\Models\Additional_number;

class AdditionalNumber {
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $candidateNumber = Additional_number::where('candidate_id', $candidate->id)->with(['numberCode', 'numberOwner'])->get()->toArray();
        if(!$candidateNumber){
            $candidateNumber = [];
        }
        return ['user_id' => $candidate['user_id'], 'candidateNumber' => $candidateNumber];
    }
}

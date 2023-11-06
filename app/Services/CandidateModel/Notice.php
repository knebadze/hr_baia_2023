<?php

namespace App\Services\CandidateModel;

use App\Models\Candidate;
use App\Models\CandidateNotice;
use Illuminate\Support\Facades\Schema;

class Notice
{
    function __invoke($user_id)
    {
        $candidate = Candidate::where('user_id', $user_id)->select('id')->first();
        $candidateNotices = CandidateNotice::where('candidate_id', $candidate->id)->with('notice')->get();

        if(!$candidateNotices){
            $candidateNotices = [];
        }

        return ['candidateNotices' => $candidateNotices, 'candidate_id' => $candidate->id];
    }
}

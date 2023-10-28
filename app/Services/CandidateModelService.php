<?php

namespace App\Services;

class CandidateModelService
{
    function findData() {

        dd('hello');
    }

    function checkStage($user_id) {
        $stage = 0;
        // if(Candidate::where('user_id', $user_id)->exists())
        return $stage;
    }
}

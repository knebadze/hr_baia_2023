<?php

namespace App\Services\CandidateModel;

use App\Models\User;

class MainInfo
{
    function __invoke($user_id)
    {
        // dd($user_id);
        return User::where('id', $user_id)->with('gender')->first();
    }
}

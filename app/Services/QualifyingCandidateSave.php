<?php

namespace App\Services;

use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\Auth;

class QualifyingCandidateSave
{
    public function TheyWillUnderstand() {

    }

    public function TheyWereInterested($request) {

        // DB::table('vacancy_interests')->insert([
            //     'vacancy_id' => $request['id'],
            //     'qualifying_type_id' => 2
            //     'user_id' => Auth::id()
            // ]);
        $interest = new QualifyingCandidate();
        $interest->vacancy_id = $request['id'];
        $interest->qualifying_type_id = 2;
        $interest->user_id = Auth::id();
        $interest->save();

        return $interest;
    }
}

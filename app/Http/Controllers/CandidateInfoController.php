<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Candidate_citizenship;
use App\Models\Candidate_profession;
use App\Models\Candidate_specialty;
use App\Models\Citizenship;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class CandidateInfoController extends Controller
{
    public function personalInfo(Request $request){
        $candidate = new Candidate();
        $candidate->user_id = $request->user_id;
        $candidate->personal_number = $request->personal_number;
        $candidate->nationality_id = $request->nationality_id;
        $candidate->religion_id = $request->religion_id;
        $candidate->education_id = $request->education_id;
        $candidate->marital_status_id = $request->marital_status_id;
        $candidate->children = $request->children;
        $candidate->children_age = $request->children_age;
        $candidate->spouse = $request->spouse;
        $candidate->save();
        $test = 0;

        foreach ($request->citizenship as $key => $value) {
            $citizenship = new Candidate_citizenship();
            $citizenship->candidate_id = $candidate->id;
            $citizenship->citizenship_id = $value;
            $test = $test + 1;
            $citizenship->save();
        }

        foreach ($request->professions as $key => $value) {
            $profession = new Candidate_profession();
            $profession->candidate_id = $candidate->id;
            $profession->profession_id = $value;
            $profession->save();
        }

        foreach ($request->specialties as $key => $value) {
            $specialty = new Candidate_specialty();
            $specialty->candidate_id = $candidate->id;
            $specialty->specialty_id = $value;
            $specialty->save();
        }
        $candidateId = $candidate->id;
        return response()->json([$request->all(), $test, $candidateId]);
    }
}

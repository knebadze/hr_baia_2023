<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Citizenship;
use Illuminate\Http\Request;
use App\Models\CandidateAllergy;
use App\Services\CandidateService;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate_specialty;
use App\Models\Candidate_profession;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate_citizenship;
use Exception;

class CandidateInfoController extends Controller
{
    private CandidateService $candidateService;
    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }
    public function addCandidate(Request $request)
    {
        $data = $request->all();

        $result = ['status' => 200];

        try {
            $result['data'] = $this->candidateService->candidateSaveData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    public function personalInfo(Request $request){
        $candidate = Candidate::updateOrCreate(
            ['user_id' => $request->user_id],
            [
                'personal_number' => $request->personal_number,
                'nationality_id' => $request->nationality_id,
                'religion_id' => $request->religion_id,
                'education_id' => $request->education_id,
                'marital_status_id' => $request->marital_status_id,
                'children' => $request->children,
                'children_age' => $request->children_age,
                'spouse' => $request->spouse,
            ]
        );
        foreach ($request->citizenship as $key => $value) {
            $citizenship = Candidate_citizenship::updateOrCreate(
                [
                    'candidate_id' => $candidate->id,
                    'citizenship_id' => $value
                ],
            );
        }
        foreach ($request->professions as $key => $value) {
            $profession = Candidate_profession::updateOrCreate(
                [
                    'candidate_id' => $candidate->id,
                    'profession_id' => $value
                ],
            );
        }

        foreach ($request->specialties as $key => $value) {
            $specialty = Candidate_specialty::updateOrCreate(
                [
                    'candidate_id' => $candidate->id,
                    'specialty_id' => $value
                ],
            );
        }

        $candidateId = $candidate->id;
        return response()->json($candidateId);
    }
    public function medicalInfo(Request $request){
        $candidate = Candidate::updateOrCreate(
            ['user_id' => Auth::id()],
            ['medical_info' => $request->medical_info]
        );
        foreach ($request->allergy as $key => $value) {
            $allergy = CandidateAllergy::updateOrCreate(
                [
                    'candidate_id' => $candidate->id,
                    'allergy_id' => $value
                ],
            );
        }
        $candidateId = $candidate->id;
        return response()->json($candidateId);
    }

    public function languageInfo(Request $request){
        print_r($request->all());
        exit;
        foreach ($request->all() as $key => $value) {

        }
        return response()->json('ok');
    }
}

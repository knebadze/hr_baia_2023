<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Candidate;
use App\Models\Citizenship;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CandidateAllergy;
use App\Services\CandidateService;
use Illuminate\Support\Facades\DB;
use App\Models\Candidate_specialty;
use App\Models\Candidate_profession;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate_citizenship;
use App\Models\CandidateNotice;

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
    public function addCandidateFile(Request $request){

        $data = $request->all();
        // $data['candidate_id'] = $request->candidate_id;
        $result = ['status' => 200];

        try {
            $result['data'] = $this->candidateService->candidateFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function removeOldWorkExperience(Request $request)
    {
        $data = $request->all();
        $result = ['status' => 200];

        try {
            $result['data'] = $this->candidateService->removeOldWorkExperience($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


}

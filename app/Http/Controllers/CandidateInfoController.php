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
        // print_r( $data);
        // exit;
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

        return response()->json('ok');
    }


}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\CandidateService;
use App\Models\CandidateRecommendation;
use Illuminate\Support\Facades\Storage;

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

    function addCandidateRecommendation(Request $request){
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            $result['data'] = $this->candidateService->addCandidateRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    function updateCandidateRecommendation(Request $request){
        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
        $result = ['status' => 200];

        try {
            $result['data'] = $this->candidateService->updateCandidateRecommendation($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
    function deleteCandidateRecommendation(Request $request) {
        $data = $request->data;
        $result = ['status' => 200];
        // dd($request->data);
        try {
            $recommendation = CandidateRecommendation::findOrFile($data['id']);
            $recommendation->delete();
            if (isset($data['file'])) {
                Storage::disk('public')->delete($data['file']);
            }
            $result['data'] = [];
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

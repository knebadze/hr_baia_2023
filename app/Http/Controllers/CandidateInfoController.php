<?php

namespace App\Http\Controllers;

use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use App\Models\CandidateNotice;
use Exception;
use Illuminate\Http\Request;
use App\Services\CandidateService;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;
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

    function deleteCandidateInfo(Request $request) {

        $result = ['status' => 200];

        try {
            if ($request->type == 'language') {
                CandidateLanguage::where('id', $request->id)->delete();
            }elseif($request->type == 'general_work'){
                General_work_experience::where('id', $request->id)->delete();
            }elseif($request->type == 'number'){
                Additional_number::where('id', $request->id)->delete();
            }elseif($request->type == 'notice'){
                $notice = CandidateNotice::where('id', $request->id)->first();
                Storage::disk('public')->delete($notice->file_path);
                $notice->delete();
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

            if ($recommendation->file) {
                Storage::disk('public')->delete($recommendation->file);
            }
            $recommendation->delete();
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

        $data['data'] = json_decode($request->input('data'));
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file');
        }
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

    // public function removeOldWorkExperience(Request $request)
    // {
    //     $data = $request->all();
    //     $result = ['status' => 200];

    //     try {
    //         $result['data'] = $this->candidateService->removeOldWorkExperience($data);
    //     } catch (Exception $e) {
    //         $result = [
    //             'status' => 500,
    //             'error' => $e->getMessage()
    //         ];
    //     }

    //     return response()->json($result, $result['status']);
    // }


}

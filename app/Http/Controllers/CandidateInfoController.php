<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CandidateNotice;
use App\Models\userRegisterLog;
use App\Models\WorkInformation;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
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
            }elseif($request->type == 'work_information'){
                WorkInformation::where('id', $request->id)->delete();
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
        $id = $request->data;
        // dd(CandidateRecommendation::where('id',$id)->first());
        $result = ['status' => 200];
        try {
            $recommendation = CandidateRecommendation::where('id',$id)->first();

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

        try {
            $data['data'] = json_decode($request->input('data'));
            if ($request->hasFile('file')) {
                $data['file'] = $request->file('file');
            }
            $result = ['status' => 200];
            $result['data'] = $this->candidateService->candidateFile($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    function addUser(Request $request)  {


        try {
            $data = $request->all();
            $result = ['status' => 200];
            $result['data'] = $this->candidateService->addUser($data);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    // function StatusUpdate(Request $request)  {
    //     dd($request->id);
    //     Candidate::where('id', $request->id)->update(['status_id'=> 9]);
    //     if (QualifyingCandidate::where('candidate_id', $request->id)->whereDate('end_date', '>', Carbon::today())->where('qualifying_type_id', 7)->exists()) {
    //         $qualifying = QualifyingCandidate::where('candidate_id', $request->id)->whereDate('end_date', '>', Carbon::today()->where('qualifying_type_id', 7))->get();
    //         $ids = collect($qualifying)->pluck('id')->toArray();
    //         WorkDay::whereIn('qualifying_candidate_id', $ids)->delete();
    //     }
    //     $currentDate = Carbon::now();
    //     QualifyingCandidate::where('candidate_id', $request->id)->whereDate('end_date', '>', Carbon::today())->update(['end_date' => $currentDate->copy()->subDay(1)->toDateString()]);
    //     return response()->json();
    // }
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

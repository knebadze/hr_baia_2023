<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\CandidateNotice;
use App\Models\WorkInformation;
use App\Models\Additional_number;
use App\Models\CandidateLanguage;
use App\Services\CandidateService;
use App\Http\Requests\AddUserRequest;
use App\Models\CandidateRecommendation;
use App\Models\General_work_experience;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CandidateModel\CandidateModelService;

class CandidateInfoController extends Controller
{
    private CandidateService $candidateService;
    private CandidateModelService $candidateModelService;
    public function __construct(CandidateService $candidateService, CandidateModelService $candidateModelService)
    {
        $this->candidateService = $candidateService;
        $this->candidateModelService = $candidateModelService;
    }

    public function addCandidate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $result = ['status' => 200];

        try {
            $updateResult = $this->candidateService->candidateSaveData($data);

            if ($updateResult['success']) {
                $result['data'] = $updateResult['data'];
            } else {
                $result = [
                    'status' => 500,
                    'error' => $updateResult['error']
                ];
            }
        } catch (\Exception $e) {
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

            $data = $request->all();
            if ($data['type'] == 'language') {
                CandidateLanguage::where('id', $data['id'])->delete();
            }elseif($data['type'] == 'general_work'){
                General_work_experience::where('id', $data['id'])->delete();
            }elseif($data['type'] == 'number'){
                Additional_number::where('id', $data['id'])->delete();
            }elseif($data['type'] == 'notice'){
                $notice = CandidateNotice::where('id', $data['id'])->first();
                Storage::disk('public')->delete($notice->file_path);
                $notice->delete();
            }elseif($data['type'] == 'work_information'){
                WorkInformation::where('id', $data['id'])->delete();
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
        // dd($data);
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

    function addUser(AddUserRequest $request) {
        
        try {
            $validated = $request->validated();

            $data = $request->all();
            $result = [
                'status' => Response::HTTP_OK,
                'data' => $this->candidateService->addUser($data),
            ];

            return response()->json($result, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    function findModel(Request $request) {
        try {

            $data = $request->all();
            $result = ['status' => 200];
            $result['data'] = $this->candidateModelService->findData($data['stage'], $data['user_id'], $data['candidate_id']);

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

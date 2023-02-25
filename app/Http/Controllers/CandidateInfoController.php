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
        // return
        // // $candidateNoticeDelete = CandidateNotice::where('candidate_id', $request->candidate_id)->get();
        // // foreach ($candidateNoticeDelete as $key => $item) {
        // //     unlink('images/user-documentation/'. $item->file);
        // // }

        // $data = $request->all();
        // foreach ($data  as $key => $value) {
        //     $test = Str::contains($key, 'file');
        //     // print_r($value->candidate_id);
        //     // exit;
        //     if ($test == true) {
        //         $notice_id = substr($key, strlen($key)-1, 1);
        //         $candidateNoticeDelete = CandidateNotice::where('candidate_id', $request->candidate_id)->first();
        //         // foreach ($candidateNoticeDelete as $key => $item) {
        //             unlink('user-documentation/'. $candidateNoticeDelete->file);
        //         // }
        //         CandidateNotice::where('candidate_id', $request->candidate_id)->where('notice_id', $notice_id)->delete();
        //         // $testArr[] = [$value->getClientOriginalName(), $notice_id];
        //         $candidateNotice = new CandidateNotice();
        //         $candidateNotice->candidate_id = $request->candidate_id;
        //         $candidateNotice->notice_id = $notice_id;

        //         $upload_path = public_path('user-documentation/');
        //         $file_name = $value->getClientOriginalName();
        //         $generated_new_name = time() . '.' . $file_name;
        //         $value->move($upload_path, $generated_new_name);
        //         $candidateNotice->file = $generated_new_name ;
        //         $candidateNotice->save();
        //     }


        // }


        // // $file_name = $request->file->getClientOriginalName();
        // return response()->json($data);
        $data = $request->all();
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


}

<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\RecommendationFromWhom;
use App\Models\CandidateRecommendation;

class WorkInformationRepository
{
    public function save($data,$candidate_id)
    {
        $workInformation = new WorkInformation();

        $workInformation->candidate_id = $candidate_id;
        $workInformation->category_id = $data['getWorkInformation']['category_id']['id'];
        $workInformation->payment = $data['getWorkInformation']['payment'];
        $workInformation->currency_id  = $data['getWorkInformation']['currency_id']['id'];
        $workInformation->save();

        $selectSchedule = collect($data['workInformationSchedule'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $workInformation->workSchedule()->sync( $selectSchedule );
        return $data;
    }

    public function update($workInformation, $data)
    {

        $workInformation->category_id = $data['category_id'];
        $workInformation->payment = $data['payment'];
        $workInformation->currency_id = $data['currency']['id'];
        $workInformation->update();
        $selectSchedule = collect($data['work_schedule'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $workInformation->workSchedule()->sync( $selectSchedule );
        return $workInformation;
    }


    public function userActiveUpdate()
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $user->update([
            'is_active' => 3,
            'updated_at' => now()
        ]);
        return $auth;
    }
    public function addRecommendation($data)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        $hasFile = false;
        foreach ($data as $key => $value) {
            if (!$value['id']) {
                $candidateRecommendation = new CandidateRecommendation();
                $candidateRecommendation->candidate_id = $candidate_id;
                $candidateRecommendation->recommendation = ($value['has_recommendation']['id']);
                $candidateRecommendation->recommendation_from_whom_id = $value['recommendation_whom']['id'];
                $candidateRecommendation->name = $value['name'];
                $candidateRecommendation->position = $value['position'];
                $candidateRecommendation->number = $value['number'];
                $candidateRecommendation->uuid = $value['uuid'];
                $candidateRecommendation->save();
            }

            if ($value['file']) {
                $hasFile = true;
            }
        }
        if ($hasFile == false) {
            $this->userActiveUpdate();
        }
        return $hasFile;
    }
    public function addNoRecommendation($data)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        foreach ($data as $key => $value) {
            $candidateRecommendation = new CandidateRecommendation();
            $candidateRecommendation->candidate_id = $candidate_id;
            $candidateRecommendation->recommendation = ($value['has_recommendation']['id']);
            $candidateRecommendation->no_reason_id = $value['no_reason']['id'];
            $candidateRecommendation->no_reason_info = $value['no_reason_info'];
            $candidateRecommendation->save();
        }
    }

    public function addRecommendationFile($data)
    {
        $upload_path = public_path('user-documentation/');
        foreach ($data as $key => $value) {
            $file_name = $value->getClientOriginalName();
            $generated_new_name = time() . '.' .$file_name;
            $recommendation = CandidateRecommendation::where('uuid', $key)->first();
            $value->move($upload_path, $generated_new_name);
            $recommendation->file = $generated_new_name;
            $recommendation->update();
        }

        $this->userActiveUpdate();

        return $data;
    }
    // public function deleteArrayRecommendation($candidate_id, $data)
    // {
    //     $recommendation = CandidateRecommendation::where('candidate_id', $candidate_id)->get();
    //     foreach ($recommendation as $key => $value) {
    //         if ($value->file) {
    //             File::delete(public_path('user-documentation/'.$value->file));
    //         }
    //     }
    //     CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
    //     $this->addRecommendation($data);
    // }
    // public function deleteRecommendation($data){
    //     // $recommendation = CandidateRecommendation::find($data['id']);
    //     // if ($recommendation->file) {
    //     //     File::delete(public_path('user-documentation/'.$recommendation->file));
    //     // }
    //     // $recommendation->delete();
    // }
    public function updateRecommendation($data)
    {
        $candidateRecommendation = CandidateRecommendation::find($data['id']);
        $candidateRecommendation->recommendation_from_whom_id = $data['recommendation_whom']['id'];
        $candidateRecommendation->name = $data['name'];
        $candidateRecommendation->position = $data['position'];
        $candidateRecommendation->number = $data['number'];
        $candidateRecommendation->update();
        return $candidateRecommendation;
    }
    public function updateNoRecommendation($data)
    {
        $candidateRecommendation = CandidateRecommendation::find($data['id']);
        $candidateRecommendation->no_reason_id = $data['no_reason']['id'];
        $candidateRecommendation->no_reason_info = $data['no_reason_info'];
        $candidateRecommendation->update();
        return $candidateRecommendation;
    }
    public function updateRecommendationFile($data)
    {
        $recommendation = CandidateRecommendation::find($data['id']);
        if ($recommendation->file) {
            $this->removeRecommendationFile($data);
        }
        $upload_path = public_path('user-documentation/');
        $file_name = $data['file']->getClientOriginalName();
        $generated_new_name = time() . '.' .$file_name;

        $data['file']->move($upload_path, $generated_new_name);
        $recommendation->file = $generated_new_name;
        $recommendation->update();
        return $file_name;
    }
    public function removeRecommendationFile($data){

        $recommendation = CandidateRecommendation::find($data['id']);
        File::delete(public_path('user-documentation/'.$recommendation->file));
        $recommendation->update(['file' => null]);
        return;
    }
    public function trashRecommendation($data)
    {
        try {

            $recommendation = CandidateRecommendation::whereIn('id', $data['id'])->get();

            foreach ($recommendation as $key => $value) {
                if ($value->file) {
                    File::delete(public_path('user-documentation/'.$value->file));
                }

            }

            CandidateRecommendation::destroy($recommendation->pluck('id')->toArray());
        }
        catch(Exception $e) {
            print_r($e);
            exit;
        }
        return $data;
    }
}

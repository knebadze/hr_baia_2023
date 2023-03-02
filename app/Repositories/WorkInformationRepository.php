<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WorkInformation;
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
        $workInformation->category_id = $data['category_id']['id'];
        $workInformation->work_schedule_id = $data['work_schedule_id']['id'];
        $workInformation->payment = $data['payment'];
        $workInformation->currency_id  = $data['currency_id']['id'];
        $workInformation->save();
        return $data;
    }

    public function update($workInformation, $data)
    {

        $workInformation->category_id = $data['category_id'];
        $workInformation->work_schedule_id = $data['work_schedule_id'];
        $workInformation->from_hour = $data['from_hour'];
        $workInformation->to_hour = $data['to_hour'];
        $workInformation->payment = $data['payment'];
        $workInformation->currency_id = $data['currency_id'];
        $workInformation->update();
        return $data;
    }

    public function updateRecommendation($workInformation, $data)
    {
        $recommendation = CandidateRecommendation::where('candidate_id',$data['candidate_id'])->where('category_id', $data['category_id'])->get();
        $recommendation->update(['category_id' => $data['category_id']]);
        $this->update($workInformation, $data);
        return $data;
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
        // print_r($data);
        // exit;
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        $hasFile = false;
        foreach ($data as $key => $value) {
            $candidateRecommendation = new CandidateRecommendation();
            $candidateRecommendation->candidate_id = $candidate_id;
            $candidateRecommendation->recommendation = (is_array($value['recommendation']))?$value['recommendation']['id']:$value['recommendation'];
            $candidateRecommendation->recommendation_from_whom_id = $value['recommendation_whom']['id'];
            $candidateRecommendation->name = $value['name'];
            $candidateRecommendation->position = $value['position'];
            $candidateRecommendation->number = $value['number'];
            $candidateRecommendation->no_reason_id = ($value['no_reason'])?$value['no_reason']['id']:$value['no_reason'];
            $candidateRecommendation->no_reason_info = $value['no_reason_info'];
            $candidateRecommendation->uuid = $value['uuid'];
            $candidateRecommendation->save();
            if ($value['file']) {
                $hasFile = true;
            }
        }
        if ($hasFile == false) {
            $this->userActiveUpdate();
        }
        return $hasFile;
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
    public function deleteRecommendation($candidate_id, $data)
    {
        $recommendation = CandidateRecommendation::where('candidate_id', $candidate_id)->get();
        foreach ($recommendation as $key => $value) {
            if ($value->file) {
                File::delete(public_path('user-documentation/'.$value->file));
            }
        }
        CandidateRecommendation::where('candidate_id', $candidate_id)->delete();
        $this->addRecommendation($data);
    }

}

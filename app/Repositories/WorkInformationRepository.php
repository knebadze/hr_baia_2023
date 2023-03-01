<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\CandidateRecommendation;
use App\Models\RecommendationFromWhom;

class WorkInformationRepository
{
    public function save($data)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        $workInformation = new WorkInformation();
        $workInformation->candidate_id = $candidate_id;
        $workInformation->category_id = $data['getWorkInformation']['category_id'];
        $workInformation->work_schedule_id = $data['getWorkInformation']['work_schedule_id'];
        $workInformation->from_hour = $data['getWorkInformation']['from_hour'];
        $workInformation->to_hour = $data['getWorkInformation']['to_hour'];
        $workInformation->payment = $data['getWorkInformation']['payment'];
        $workInformation->currency_id  = $data['getWorkInformation']['currency_id'];
        $workInformation->save();

        if ($data['candidateRecommendationModel'] != []) {
            $candidateRecommendation = new CandidateRecommendation();
            $candidateRecommendation->candidate_id = $candidate_id;
            $candidateRecommendation->category_id = $data['getWorkInformation']['category_id'];
            $candidateRecommendation->no_reason_id = $data['candidateRecommendationModel']['no_reason_id'];
            $candidateRecommendation->no_reason_info = $data['candidateRecommendationModel']['no_reason_info'];
            $candidateRecommendation->save();
        }
        return $data;
    }

    public function addRecommendation($data)
    {
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        $candidateRecommendation = new CandidateRecommendation();
        $candidateRecommendation->candidate_id = $candidate_id;
        $candidateRecommendation->category_id = $data['category_id'];
        $candidateRecommendation->recommendation = $data['recommendation'];
        $candidateRecommendation->recommendation_from_whom_id = $data['recommendation_from_whom_id'];
        $candidateRecommendation->name = $data['name'];
        $candidateRecommendation->	position = $data['position'];
        $candidateRecommendation->number = $data['number'];
        $candidateRecommendation->no_reason_id = $data['no_reason_id'];
        $candidateRecommendation->no_reason_info = $data['no_reason_info'];
        $candidateRecommendation->save();
        return $candidateRecommendation->id;
    }
    public function addRecommendationFile($data)
    {
        $upload_path = public_path('user-documentation/');
        $file_name = $data['file']->getClientOriginalName();
        $generated_new_name = time() . '.' .$file_name;
        $recommendation = CandidateRecommendation::where('id', $data['id'])->first();
        $data['file']->move($upload_path, $generated_new_name);
        $recommendation->file = $generated_new_name;
        $recommendation->update();

        return $recommendation;
    }

}

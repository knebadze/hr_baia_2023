<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\CandidateRecommendation;

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
        // $workInformation->save();

        foreach ($data['candidateRecommendation'] as $key => $value) {
            $candidateRecommendation = new CandidateRecommendation();
            $candidateRecommendation->candidate_id = $candidate_id;
            $candidateRecommendation->category_id = $data['getWorkInformation']['category_id'];
            $candidateRecommendation->recommendation_from_whom_id = $value['recommendation_from_whom_id'];
            $candidateRecommendation->name = $value['name'];
            $candidateRecommendation->	position = $value['position'];
            $candidateRecommendation->number = $value['number'];
            $candidateRecommendation->no_reason_id = $value['no_reason_id'];
            $candidateRecommendation->no_reason_info = $value['no_reason_info'];
            // $candidateRecommendation->save();
        }
        return $data;
    }
}

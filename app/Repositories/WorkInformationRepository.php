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
use App\Models\NoFamilyWorkExperience;

class WorkInformationRepository
{
    public function save($data,$candidate_id)
    {
        $workInformation = new WorkInformation();

        $workInformation->candidate_id = $candidate_id;
        $workInformation->category_id = $data['getWorkInformation']['category_id']['id'];
        $workInformation->payment = $data['getWorkInformation']['payment'];
        $workInformation->currency_id  = $data['getWorkInformation']['currency_id']['id'];
        $workInformation->additional_schedule_ka = $data['getWorkInformation']['additional_schedule_ka'];
        $workInformation->additional_schedule_en = $data['getWorkInformation']['additional_schedule_en'];
        $workInformation->additional_schedule_ru = $data['getWorkInformation']['additional_schedule_ru'];
        $workInformation->save();

        $selectSchedule = collect($data['workInformationSchedule'])->reduce(function ($carry, $item) {
            if($carry  == null) $carry = [];
            $carry[] = $item['id'];
            return $carry;
        }, []);
        $workInformation->workSchedule()->sync( $selectSchedule );

        if (count($data['noFamilyWorkExperience']) > 0 ) {
            if ($data['noFamilyWorkExperience'][0]['has_experience']['id'] == 1) {
                $this->noFamilyHasWorkExperience($data['noFamilyWorkExperience'], $workInformation->id);
            }else{
                $this->noFamilyHasNotWorkExperience($data['noFamilyWorkExperience'][0], $workInformation->id);
            }

        }
        return $data;
    }

    public function noFamilyHasWorkExperience($data, $id)
    {
        foreach ($data as $key => $value) {
            $noFamilyWorkExperience = new NoFamilyWorkExperience();
            $noFamilyWorkExperience->work_information_id = $id;
            $noFamilyWorkExperience->experience	= $value['has_experience']['id'];
            $noFamilyWorkExperience->work_experience_id = $value['work_experience']['id'];
            $noFamilyWorkExperience->object_ka = $value['object_ka'];
            $noFamilyWorkExperience->object_en = $value['object_en'];
            $noFamilyWorkExperience->object_ru = $value['object_ru'];
            $noFamilyWorkExperience->save();
        }
    }

    public function noFamilyHasNotWorkExperience($data, $id)
    {
            $noFamilyWorkExperience = new NoFamilyWorkExperience();
            $noFamilyWorkExperience->work_information_id = $id;
            $noFamilyWorkExperience->experience	= $data['has_experience']['id'];
            $noFamilyWorkExperience->no_reason_id = $data['no_reason']['id'];
            $noFamilyWorkExperience->no_reason_info_ka = $data['no_reason_info_ka'];
            $noFamilyWorkExperience->no_reason_info_en = $data['no_reason_info_en'];
            $noFamilyWorkExperience->no_reason_info_en = $data['no_reason_info_en'];
            $noFamilyWorkExperience->save();
    }
    public function update($workInformation, $data)
    {

        $workInformation->category_id = $data['category_id'];
        $workInformation->payment = $data['payment'];
        $workInformation->currency_id = $data['currency']['id'];
        $workInformation->additional_schedule_ka = $data['additional_schedule_ka'];
        $workInformation->additional_schedule_en = $data['additional_schedule_en'];
        $workInformation->additional_schedule_ru = $data['additional_schedule_ru'];
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
        if ($user->status == 1) {
            $user->update([
                'status' => 2,
                'updated_at' => now()
            ]);
        }

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
                $candidateRecommendation->name_ka = $value['name_ka'];
                $candidateRecommendation->name_en = $value['name_en'];
                $candidateRecommendation->name_ru = $value['name_ru'];
                $candidateRecommendation->position_ka = $value['position_ka'];
                $candidateRecommendation->position_en = $value['position_en'];
                $candidateRecommendation->position_ru = $value['position_ru'];
                $candidateRecommendation->number_code_id = $value['number_code']['id'];
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
            $candidateRecommendation->no_reason_info_ka = $value['no_reason_info_ka'];
            $candidateRecommendation->no_reason_info_en = $value['no_reason_info_en'];
            $candidateRecommendation->no_reason_info_en = $value['no_reason_info_en'];
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
        $candidateRecommendation->name_ka = $data['name_ka'];
        $candidateRecommendation->name_en = $data['name_en'];
        $candidateRecommendation->name_ru = $data['name_ru'];
        $candidateRecommendation->position_ka = $data['position_ka'];
        $candidateRecommendation->position_en = $data['position_en'];
        $candidateRecommendation->position_ru = $data['position_ru'];
        $candidateRecommendation->number = $data['number'];
        $candidateRecommendation->update();
        return $candidateRecommendation;
    }
    public function updateNoRecommendation($data)
    {
        $candidateRecommendation = CandidateRecommendation::find($data['id']);
        $candidateRecommendation->no_reason_id = $data['no_reason']['id'];
        $candidateRecommendation->no_reason_info_ka = $data['no_reason_info_ka'];
        $candidateRecommendation->no_reason_info_en = $data['no_reason_info_en'];
        $candidateRecommendation->no_reason_info_en = $data['no_reason_info_en'];
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

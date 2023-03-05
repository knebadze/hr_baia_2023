<?php

namespace App\Services;

use App\Models\CandidateRecommendation;
use App\Models\User;
use App\Models\WorkInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\WorkInformationRepository;
use LDAP\Result;

class WorkInformationService
{
    protected $workInformationRepository;

    public function __construct(WorkInformationRepository $workInformationRepository)
    {
        $this->workInformationRepository = $workInformationRepository;
    }
    public function saveData($data)
    {
        // print_r($data);
        // exit;
        $result = null;
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        if (DB::table('work_information')->where('candidate_id', $candidate_id)->where('category_id', $data['getWorkInformation']['category_id']['id'])->exists()) {
            return $result = ['message' => 'თქვენს მიერ მითითებულ კატეგორიაზე უკვე არსებობს ინფორმაცია'];
        }
        $result = $this->workInformationRepository->save($data, $candidate_id);
        return $result;
    }
    public function updateData($data)
    {
        $workInformation = WorkInformation::find($data['id']);
        if ($workInformation->category_id == $data['category_id']){
            $result = $this->workInformationRepository->update($workInformation,$data);
            return $result;
        }else {
            $result = null;
            if (DB::table('work_information')->where('candidate_id',$data['candidate_id'])->where('category_id', $data['category_id'])->exists()) {
                $result = ['message' => 'თქვენს მიერ მითითებულ კატეგორიაზე უკვე არსებობს ინფორმაცია'];
            }else{
                $result = $this->workInformationRepository->updateRecommendation($workInformation, $data);
            }
            return $result;
        }



    }


    public function saveRecommendation($data)
    {
        if ($data[0]['has_recommendation']['id'] == 1) {
            $result = $this->workInformationRepository->addRecommendation($data);
            return $result;
        }else{
            $result = $this->workInformationRepository->addNoRecommendation($data);
            return $result;
        }
    }
    public function saveRecommendationFile($data)
    {
        $result = $this->workInformationRepository->addRecommendationFile($data);
        return $result;
    }

    public function updateRecommendation($data)
    {
        if ($data['recommendation'] == 1) {
            $result = $this->workInformationRepository->updateRecommendation($data);
            return $result;
        }else{
            $result = $this->workInformationRepository->updateNoRecommendation($data);
            return $result;
        }

    }
    public function updateRecommendationFile($data)
    {
        $result = $this->workInformationRepository->updateRecommendationFile($data);
        return $result;
    }

    public function removeRecommendationFile($data)
    {
        $result = $this->workInformationRepository->removeRecommendationFile($data);
        return $result;
    }
    public function trashRecommendation($data)
    {
        $result = $this->workInformationRepository->trashRecommendation($data);
        return $result;
    }
}

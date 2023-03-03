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
        $result = null;
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        if (DB::table('work_information')->where('candidate_id', $candidate_id)->where('category_id', $data['category_id']['id'])->exists()) {
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
        $auth = Auth::user();
        $user = User::where('id', $auth->id)->first();
        $candidate_id = $user->candidate->id;
        if (DB::table('candidate_recommendations')->exists() && DB::table('candidate_recommendations')->where('candidate_id', $candidate_id)->exists()) {
            $recommendation = CandidateRecommendation::where('candidate_id', $candidate_id)->get();
                if ($recommendation[0]->recommendation == 1) {
                    $result = $this->workInformationRepository->deleteArrayRecommendation($candidate_id, $data);
                    return $result;
                }else{
                    $result = $this->workInformationRepository->deleteRecommendation($candidate_id, $data);
                    return $result;
                }

        }
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
        $result = $this->workInformationRepository->updateRecommendation($data);
        return $result;
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
}

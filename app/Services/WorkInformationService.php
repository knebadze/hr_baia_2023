<?php

namespace App\Services;

use App\Models\WorkInformation;
use App\Repositories\WorkInformationRepository;

class WorkInformationService
{
    protected $workInformationRepository;

    public function __construct(WorkInformationRepository $workInformationRepository)
    {
        $this->workInformationRepository = $workInformationRepository;
    }
    public function saveData($data)
    {
        $result = $this->workInformationRepository->save($data);
        return $result;
    }
    public function updateData($data)
    {
        $workInformation = WorkInformation::where('candidate_id',$data['candidate_id'])->where('category_id', $data['category_id'])->first();
        if ($workInformation->category_id == $data['category_id']){
            $result = $this->workInformationRepository->update($workInformation,$data);
            return $result;
        }else {
            $result = $this->workInformationRepository->updateRecommendation($workInformation, $data);
            // $result = $this->workInformationRepository->update($workInformation, $data);
            return $result;
        }



    }


    public function saveRecommendation($data)
    {
        $result = $this->workInformationRepository->addRecommendation($data);
        return $result;
    }
    public function saveRecommendationFile($data)
    {
        $result = $this->workInformationRepository->addRecommendationFile($data);
        return $result;
    }

}

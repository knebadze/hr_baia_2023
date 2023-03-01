<?php

namespace App\Services;

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

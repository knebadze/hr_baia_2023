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

}

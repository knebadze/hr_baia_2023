<?php

namespace App\Services;

use App\Repositories\Candidate\WorkInformationRepository;
use App\Repositories\Candidate\FamilyWorkExperienceRepository;

class WorkInformationService
{
    protected WorkInformationRepository $workInformationRepository;
    protected FamilyWorkExperienceRepository $familyWorkExperienceRepository;
    public function __construct()
    {
        $this->workInformationRepository = new WorkInformationRepository;
        $this->familyWorkExperienceRepository = new FamilyWorkExperienceRepository;
    }

    function saveData($data) {
        if($data['type'] == 'work_information'){
            $result = $this->workInformationRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'family_work_information'){
            $result = $this->familyWorkExperienceRepository->updateOrCreate($data['model']);
        }

        return $result;
    }

}

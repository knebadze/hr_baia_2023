<?php

namespace App\Services;

use App\Repositories\FamilyWorkExperienceRepository;

class FamilyWorkExperienceService
{
    protected $familyWorkExperienceRepository;

    public function __construct(FamilyWorkExperienceRepository $familyWorkExperienceRepository)
    {
        $this->familyWorkExperienceRepository = $familyWorkExperienceRepository;
    }
    public function saveData($data)
    {
        $result = $this->familyWorkExperienceRepository->save($data);
        return $result;
    }
}

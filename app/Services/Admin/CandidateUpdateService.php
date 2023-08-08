<?php

namespace App\Services\Admin;
use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\NumberRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\WorkInformationRepository;
use App\Repositories\Candidate\FamilyWorkExperienceRepository;
use App\Repositories\Candidate\GeneralWorkExperienceRepository;

class CandidateUpdateService
{
    protected CandidateRepository $candidateRepository;
    protected LanguageRepository $languageRepository;
    protected GeneralWorkExperienceRepository $generalWorkExperienceRepository;
    protected WorkInformationRepository $workInformationRepository;
    protected FamilyWorkExperienceRepository $familyWorkExperienceRepository;
    protected NumberRepository $numberRepository;
    public function __construct()
    {
        $this->candidateRepository = new CandidateRepository;
        $this->languageRepository = new LanguageRepository;
        $this->generalWorkExperienceRepository = new GeneralWorkExperienceRepository;
        $this->workInformationRepository = new WorkInformationRepository;
        $this->familyWorkExperienceRepository = new FamilyWorkExperienceRepository;
        $this->numberRepository = new NumberRepository;
    }

    function update($data)  {
        if ($data['type'] == 'main') {
            $result = $this->candidateRepository->update($data['model']);
        }else if ($data['type'] == 'language') {
            $result = $this->languageRepository->update($data['model']);
        }else if($data['type'] == 'general_work_experience'){
            $result = $this->generalWorkExperienceRepository->update($data['model']);
        }else if($data['type'] == 'work_information'){
            $result = $this->workInformationRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'work_information_delete'){
            $result = $this->workInformationRepository->delete($data['model']);
        }else if($data['type'] == 'family_work_experience'){
            $result = $this->familyWorkExperienceRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'number'){
            $result = $this->numberRepository->update($data['model']);
        }

        return $result;
    }
}

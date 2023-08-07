<?php

namespace App\Services\Admin;

use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\NumberRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\WorkInformationUpdateRepository;
use App\Repositories\Candidate\FamilyWorkExperienceUpdateRepository;
use App\Repositories\Candidate\GeneralWorkExperienceRepository;

class CandidateUpdateService
{
    protected CandidateRepository $candidateRepository;
    protected LanguageRepository $languageRepository;
    protected GeneralWorkExperienceRepository $generalWorkExperienceRepository;
    protected WorkInformationUpdateRepository $workInformationUpdateRepository;
    protected FamilyWorkExperienceUpdateRepository $familyWorkExperienceUpdateRepository;
    protected NumberRepository $numberRepository;
    public function __construct()
    {
        $this->candidateRepository = new CandidateRepository;
        $this->languageRepository = new LanguageRepository;
        $this->generalWorkExperienceRepository = new GeneralWorkExperienceRepository;
        $this->workInformationUpdateRepository = new WorkInformationUpdateRepository;
        $this->familyWorkExperienceUpdateRepository = new FamilyWorkExperienceUpdateRepository;
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
            $result = $this->workInformationUpdateRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'work_information_delete'){
            $result = $this->workInformationUpdateRepository->delete($data['model']);
        }else if($data['type'] == 'family_work_experience'){
            $result = $this->familyWorkExperienceUpdateRepository->update($data['model']);
        }else if($data['type'] == 'number'){
            $result = $this->numberRepository->update($data['model']);
        }

        return $result;
    }
}

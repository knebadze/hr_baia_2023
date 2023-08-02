<?php

namespace App\Services\Admin;

use App\Repositories\Candidate\NumberUpdateRepository;
use App\Repositories\Candidate\LanguageUpdateRepository;
use App\Repositories\Candidate\CandidateUpdateRepository;
use App\Repositories\Candidate\WorkInformationUpdateRepository;
use App\Repositories\Candidate\FamilyWorkExperienceUpdateRepository;
use App\Repositories\Candidate\GeneralWorkExperienceUpdateRepository;

class CandidateUpdateService
{
    protected CandidateUpdateRepository $candidateUpdateRepository;
    protected LanguageUpdateRepository $languageUpdateRepository;
    protected GeneralWorkExperienceUpdateRepository $generalWorkExperienceUpdateRepository;
    protected WorkInformationUpdateRepository $workInformationUpdateRepository;
    protected FamilyWorkExperienceUpdateRepository $familyWorkExperienceUpdateRepository;
    protected NumberUpdateRepository $numberUpdateRepository;
    public function __construct()
    {
        $this->candidateUpdateRepository = new CandidateUpdateRepository;
        $this->languageUpdateRepository = new LanguageUpdateRepository;
        $this->generalWorkExperienceUpdateRepository = new GeneralWorkExperienceUpdateRepository;
        $this->workInformationUpdateRepository = new WorkInformationUpdateRepository;
        $this->familyWorkExperienceUpdateRepository = new FamilyWorkExperienceUpdateRepository;
        $this->numberUpdateRepository = new NumberUpdateRepository;
    }

    function update($data)  {
        if ($data['type'] == 'main') {
            $result = $this->candidateUpdateRepository->update($data['model']);
        }else if ($data['type'] == 'language') {
            $result = $this->languageUpdateRepository->update($data['model']);
        }else if($data['type'] == 'general_work_experience'){
            $result = $this->generalWorkExperienceUpdateRepository->update($data['model']);
        }else if($data['type'] == 'work_information'){
            $result = $this->workInformationUpdateRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'work_information_delete'){
            $result = $this->workInformationUpdateRepository->delete($data['model']);
        }else if($data['type'] == 'family_work_experience'){
            $result = $this->familyWorkExperienceUpdateRepository->update($data['model']);
        }else if($data['type'] == 'number'){
            $result = $this->numberUpdateRepository->update($data['model']);
        }

        return $result;
    }
}

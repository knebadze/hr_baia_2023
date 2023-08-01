<?php

namespace App\Services\Admin;

use App\Repositories\Candidate\LanguageUpdateRepository;
use App\Repositories\Candidate\GeneralWorkExperienceUpdateRepository;

class CandidateUpdateService
{
    protected LanguageUpdateRepository $languageUpdateRepository;
    protected GeneralWorkExperienceUpdateRepository $generalWorkExperienceUpdateRepository;
    public function __construct()
    {
        $this->languageUpdateRepository = new LanguageUpdateRepository;
        $this->generalWorkExperienceUpdateRepository = new GeneralWorkExperienceUpdateRepository;
    }

    function update($data)  {
        if ($data['type'] == 'language') {
            $result = $this->languageUpdateRepository->update($data['model']);
        }else if($data['type'] == 'genera_work_experience'){
            $result = $this->generalWorkExperienceUpdateRepository->update($data['model']);
        }

        return $result;
    }
}

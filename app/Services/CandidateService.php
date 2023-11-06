<?php

namespace App\Services;

use App\Repositories\Candidate\NumberRepository;
use App\Repositories\Candidate\AddressRepository;
use App\Repositories\Candidate\AddUserRepository;
use App\Repositories\Candidate\LanguageRepository;
use App\Repositories\Candidate\CandidateRepository;
use App\Repositories\Candidate\RecommendationRepository;
use App\Repositories\Candidate\CandidateNoticeRepository;
use App\Repositories\Candidate\WorkInformationRepository;
use App\Repositories\Candidate\FamilyWorkExperienceRepository;
use App\Repositories\Candidate\GeneralWorkExperienceRepository;


class CandidateService
{
    protected CandidateRepository $candidateRepository;
    protected AddressRepository $addressRepository;
    protected LanguageRepository $languageRepository;
    protected RecommendationRepository $recommendationRepository;
    protected GeneralWorkExperienceRepository $generalWorkExperienceRepository;
    protected NumberRepository $numberRepository;
    protected CandidateNoticeRepository $candidateNoticeRepository;
    protected AddUserRepository $addUserRepository;
    protected WorkInformationRepository $workInformationRepository;
    protected FamilyWorkExperienceRepository $familyWorkExperienceRepository;
    public function __construct()
    {
        $this->candidateRepository = new  CandidateRepository;
        $this->addressRepository = new  AddressRepository;
        $this->languageRepository = new LanguageRepository;
        $this->generalWorkExperienceRepository = new GeneralWorkExperienceRepository;
        $this->recommendationRepository = new RecommendationRepository;
        $this->numberRepository = new NumberRepository;
        $this->candidateNoticeRepository = new CandidateNoticeRepository;
        $this->addUserRepository = new AddUserRepository;
        $this->workInformationRepository = new WorkInformationRepository;
        $this->familyWorkExperienceRepository = new FamilyWorkExperienceRepository;
    }


    function addUser($data) {
        $result = $this->addUserRepository->save($data);
        return $result;
    }
    public function candidateSaveData($data)
    {
        // dd($data);
        if($data['type'] == 'main'){
            $result = $this->addUserRepository->update($data['model']);
        }else if ($data['type'] == 'information') {
            $result = $this->candidateRepository->save($data['model']);
        }elseif ($data['type'] == 'address') {
            $result = $this->addressRepository->save($data['model'], $data['model']['user_id']);
        }elseif ($data['type'] == 'language') {
            $result = $this->languageRepository->save($data['model'], $data['user_id']);
        }elseif($data['type'] == 'general_work'){
            $result = $this->generalWorkExperienceRepository->save($data['model'], $data['user_id']);
        }elseif($data['type'] == 'number'){
            $result = $this->numberRepository->save($data['model'], $data['user_id']);
        }else  if($data['type'] == 'work_information'){
            $result = $this->workInformationRepository->updateOrCreate($data['model']);
        }else if($data['type'] == 'family_work_information'){
            $result = $this->familyWorkExperienceRepository->updateOrCreate($data['model']);
        }

        return $result;
    }

    function addCandidateRecommendation($data){
        $result = $this->recommendationRepository->save($data);
        return $result;
    }
    function updateCandidateRecommendation($data)  {
        $result = $this->recommendationRepository->update($data);
        return $result;
    }
    public function candidateFile($data){
        $result = $this->candidateNoticeRepository->save($data);
        return $result;
    }

    // public function removeOldWorkExperience($data)
    // {
    //     $result = $this->candidateRepository->removeOldWorkExperience($data);
    //     return $result;
    // }
}

<?php

namespace App\Services;

use App\Models\Candidate;
use App\Repositories\Vacancy\AddVacancyPersonalRepository;

class AddVacancyPersonalService
{
    protected AddVacancyPersonalRepository $addVacancyPersonalRepository;
    public function __construct()
    {
        $this->addVacancyPersonalRepository = new AddVacancyPersonalRepository;
    }

    function addPersonal($data) {
        $result = null;
        if (gettype($data['candidate_id']) == 'array') {
            $result = $this->addVacancyPersonalRepository->addArr($data);
            return $result;
        }
        $result = $this->addVacancyPersonalRepository->add($data);
        return $result;
    }

    function updatePersonal($data) {
        if (gettype($data['candidate_id']) == 'array') {

            $result = $this->addVacancyPersonalRepository->updateArr($data);
            return $result;
        }
        $result = $this->addVacancyPersonalRepository->update($data);
        return $result;
    }
    function deletePersonal($data) {
        $result = $this->addVacancyPersonalRepository->delete($data);
        return $result;
    }

    function addPersonalWasEmployed($data){
        $result = $this->addVacancyPersonalRepository->wasEmployed($data);
        return $result;
    }
}

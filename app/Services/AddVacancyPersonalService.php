<?php

namespace App\Services;

use App\Repositories\Vacancy\AddVacancyPersonalRepository;

class AddVacancyPersonalService
{
    protected AddVacancyPersonalRepository $addVacancyPersonalRepository;
    public function __construct()
    {
        $this->addVacancyPersonalRepository = new AddVacancyPersonalRepository;
    }

    function addPersonal($data) {
        $result = $this->addVacancyPersonalRepository->add($data);
        return $result;
    }

    function updatePersonal($data) {
        $result = $this->addVacancyPersonalRepository->update($data);
        return $result;
    }
}

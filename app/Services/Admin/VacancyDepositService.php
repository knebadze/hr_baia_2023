<?php

namespace App\Services\Admin;

use App\Repositories\Vacancy\VacancyDepositRepository;
use App\Repositories\Vacancy\VacancyRedactedRepository;

class VacancyDepositService
{
    protected VacancyDepositRepository $vacancyDepositRepository;
    protected VacancyRedactedRepository $vacancyRedactedRepository;
    public function __construct()
    {
        $this->vacancyDepositRepository = new VacancyDepositRepository;
        $this->vacancyRedactedRepository = new VacancyRedactedRepository;
    }

    public function save($data) {
        $result = $this->vacancyDepositRepository->save($data['model']);
        return $result;
    }
    public function update($data) {
        $update = $this->vacancyDepositRepository->update($data['model']);
        $history = $this->vacancyRedactedRepository->save($data['model']['id'], $data['edit']);
        $result = [$update, $history];
        return $result;
    }
}

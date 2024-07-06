<?php

namespace App\Services\Admin;

use App\Repositories\Vacancy\VacancyDepositRepository;

class VacancyDepositService
{
    protected VacancyDepositRepository $vacancyDepositRepository;
    public function __construct()
    {
        $this->vacancyDepositRepository = new VacancyDepositRepository;
    }

    public function save($data) {
        $result = $this->vacancyDepositRepository->save($data['model'], $data['type']);
        return $result;
    }
    public function update($data) {
        $result = $this->vacancyDepositRepository->update($data['model'], $data['type']);

        return $result;
    }
}

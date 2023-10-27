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
        // dd($data);
        $result = $this->vacancyDepositRepository->save($data['model'], $data['type']);
        return $result;
    }
    public function update($data) {
        $update = $this->vacancyDepositRepository->update($data['model'], $data['type']);

        $history = $this->vacancyRedactedRepository->save($data['model']['vacancy_id'], $data['edit']);
        $result = [$update, $history];
        return $result;
    }
}

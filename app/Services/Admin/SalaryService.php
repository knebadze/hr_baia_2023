<?php

namespace App\Services\Admin;

use App\Repositories\Salary\SalaryPageRepository;

class SalaryService
{
    protected SalaryPageRepository $salaryPageRepository;
    public function __construct()
    {
        $this->salaryPageRepository = new SalaryPageRepository;
    }

    function data()  {
        $result = $this->salaryPageRepository->data();

        return $result;
    }
}

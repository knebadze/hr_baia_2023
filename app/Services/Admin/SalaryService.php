<?php

namespace App\Services\Admin;

use App\Repositories\Salary\SalaryPageRepository;
use App\Repositories\Salary\DisbursementOfSalaryRepository;

class SalaryService
{
    protected SalaryPageRepository $salaryPageRepository;
    protected DisbursementOfSalaryRepository $disbursementOfSalaryRepository;
    public function __construct()
    {
        $this->salaryPageRepository = new SalaryPageRepository;
        $this->disbursementOfSalaryRepository = new DisbursementOfSalaryRepository;
    }

    function data()  {
        $result = $this->salaryPageRepository->data();

        return $result;
    }

    function disbursement($data) {
        // dd($data);
        $result = [];
        if(!$data['check']){
            $result = $this->disbursementOfSalaryRepository->check($data['items']);
        }else{
            $result = $this->disbursementOfSalaryRepository->action($data['items']);
        }
        return $result;
    }
}

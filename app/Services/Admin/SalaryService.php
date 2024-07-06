<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
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

    function data($childView)  {
        $result = $this->salaryPageRepository->data($childView);

        return $result;
    }

    function disbursement($data, $childView) {
        $result = [];
        $authId = Auth::guard('staff')->user()->id;
        if(!$data['check']){
            $result = $this->disbursementOfSalaryRepository->check($data['items'], $childView, $authId);
        }else{
            $result = $this->disbursementOfSalaryRepository->action($data['items'], $childView, $authId);
        }
        return $result;
    }


}

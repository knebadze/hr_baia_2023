<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Enrollment\EnrollmentRepository;
use App\Repositories\Enrollment\EnrollmentPageRepository;
use App\Repositories\Enrollment\EnrollmentUpdateRepository;

class EnrollmentService
{
    protected EnrollmentRepository $enrollmentRepository;
    protected EnrollmentPageRepository $enrollmentPageRepository;
    protected EnrollmentUpdateRepository $enrollmentUpdateRepository;
    public function __construct()
    {
        $this->enrollmentRepository = new EnrollmentRepository;
        $this->enrollmentPageRepository = new EnrollmentPageRepository;
        $this->enrollmentUpdateRepository = new EnrollmentUpdateRepository;
    }
    function save($type, $data) {
        if ($type == 'vacancy') {
            $result = $this->enrollmentRepository->vacancy($data);
        }

        return $result;
    }
    function pageData(){
        if (Auth::user()->role_id == 1) {
            $result = $this->enrollmentPageRepository->adminData();
        }else{
            $result = $this->enrollmentPageRepository->hrData();
        }

        return $result;
    }

    function update($data) {
        $result = $this->enrollmentUpdateRepository->update($data);

        return $result;
    }

    function agree($data) {
        $result = $this->enrollmentUpdateRepository->agree($data);

        return $result;
    }
}

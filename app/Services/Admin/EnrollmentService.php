<?php

namespace App\Services\Admin;

use App\Models\Vacancy;
use App\Repositories\Enrollment\EnrollmentRepository;
use App\Repositories\Enrollment\EnrollmentPageRepository;
use App\Repositories\Enrollment\EnrollmentAgreeRepository;
use App\Repositories\Enrollment\EnrollmentUpdateRepository;

class EnrollmentService
{
    protected EnrollmentRepository $enrollmentRepository;
    protected EnrollmentPageRepository $enrollmentPageRepository;
    protected EnrollmentUpdateRepository $enrollmentUpdateRepository;
    protected EnrollmentAgreeRepository $enrollmentAgreeRepository;
    public function __construct()
    {
        $this->enrollmentRepository = new EnrollmentRepository;
        $this->enrollmentPageRepository = new EnrollmentPageRepository;
        $this->enrollmentUpdateRepository = new EnrollmentUpdateRepository;
        $this->enrollmentAgreeRepository = new EnrollmentAgreeRepository;
    }
    function save($type, $data) {
        try {
            $vacancy = Vacancy::where('id', $data['data']->vacancy_id)->first();
            if ($type == 'vacancy') {
                $result = $this->enrollmentRepository->vacancy($data, $vacancy);
            }else if ($type == 'register') {
                $result = $this->enrollmentRepository->register($data, $vacancy);
            }

            return $result;
        } catch (\Exception $e) {
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }

    }
    function pageData(){
        try {
            $result = $this->enrollmentPageRepository->data();
            return $result;
        } catch (\Exception $e) {
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }

    }

    function update($data) {
        try {
            $result = $this->enrollmentUpdateRepository->update($data);
            return $result;
        } catch (\Exception $e) {
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }

    }

    function agree($data) {
        try {
            $result = $this->enrollmentAgreeRepository->agree($data);
            return $result;
        } catch (\Exception $e) {
            dd($e);
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }
    }
}

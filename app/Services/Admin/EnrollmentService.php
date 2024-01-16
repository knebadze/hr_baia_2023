<?php

namespace App\Services\Admin;

use App\Models\Hr;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Cache;
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
        // dd($data['data']);
        try {
            $vacancy = Vacancy::where('id', $data['data']->vacancy_id)->first();
            if ($type == 'vacancy') {
                $result = $this->enrollmentRepository->vacancy($data, $vacancy);
            }else if ($type == 'register') {
                $result = $this->enrollmentRepository->register($data, $vacancy);
            }

            $admin = Cache::rememberForever('admin_user', function () use ($type) {
                return User::where('role_id', 1)->get();
            });
            $words = explode(' ', $vacancy->hr->user->name_ka);

            // Extract the first letter from each word and create initials
            $initials = '';
            foreach ($words as $word) {
                $initials .= strtoupper($word[0]) . '.';
            }

            // Remove the trailing dot from the last initial
            $initials = rtrim($initials, '.');
            $currentUrl = url()->current();
            $parsedUrl = parse_url($currentUrl);

            // Create the base URL
            $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'].':'.$parsedUrl['port'];

            $smsData = [ 'hrInicial' => $initials, 'money' => $data['data']->money, 'code'=> $vacancy->code, 'url' => $baseUrl.'/admin/enrollment'];
            foreach ($admin as $key => $value) {
                $smsData['to'] = $value->number;
                $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_admin');
            }


            return $result;
        } catch (\Exception $e) {
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }

    }
    function pageData(){
        try {
            // dd($this->enrollmentPageRepository->data());
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
        // dd($data);
        try {
            $result = $this->enrollmentAgreeRepository->agree($data);
            $currentUrl = url()->current();
            $parsedUrl = parse_url($currentUrl);
            $user = User::where('id', $data['author_id'])->first();
            // Create the base URL
            $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'].':'.$parsedUrl['port'];
            $smsData = ['to' => $user->number, 'money' => $data['money'], 'code'=> $data['code'], 'url' => $baseUrl.'/admin/enrollment'];
            $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_hr');
            return $result;
        } catch (\Exception $e) {
            dd($e);
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }
    }
}

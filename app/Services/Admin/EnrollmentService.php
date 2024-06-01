<?php

namespace App\Services\Admin;

use App\Models\RegistrationFee;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Enrollment\EnrollmentRepository;
use App\Repositories\Enrollment\EnrollmentPageRepository;
use App\Repositories\Enrollment\EnrollmentAgreeRepository;
use App\Repositories\Enrollment\EnrollmentUpdateRepository;
use Illuminate\Support\Facades\Log;

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
            $vacancy = Vacancy::findOrFail($data['data']->vacancy_id);
    
            $result = $type == 'vacancy' 
                ? $this->enrollmentRepository->vacancy($data, $vacancy)
                : $this->enrollmentRepository->register($data, $vacancy->hr->user->id);
    
            $admin = Cache::rememberForever('admin_user', function () {
                return User::where('role_id', 1)->whereNot('id', 2)->get();
            });
    
            $initials = $vacancy->hr->user->name_ka;
    
            $baseUrl = url()->current();
    
            function sanitizeString($string) {
                return mb_convert_encoding($string, 'UTF-8', 'UTF-8');
            }
            $smsData = [ 
                'hrInicial' => sanitizeString($initials), 
                'money' => $data['data']->money, 
                'code'=> $vacancy->code, 
                'url' => "{$baseUrl}/admin/enrollment"
            ];
            
            foreach ($admin as $user) {
                $smsData['to'] = $user->number;
                $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_admin');
            }
            return $result;
        } catch (\Exception $e) {
            Log::error('An error occurred during enrollment agreement: ' . $e->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }
    }

    function registerFee($type, $data) {
        try {
            $fee = RegistrationFee::where('user_id', $data['data']->user_id)->first();
            $author_id = $fee->hr->user->id;
            $result = $this->enrollmentRepository->register($data, $author_id);
    
            // $admin = Cache::rememberForever('admin_user', function () {
            //     return User::where('role_id', 1)->whereNot('id', 2)->get();
            // });
    
            // $initials = $vacancy->hr->user->name_ka;
    
            // $baseUrl = url()->current();
    
         
            // $smsData = [ 
            //     'hrInicial' => $initials, 
            //     'money' => $data['data']->money, 
            //     // 'code'=> $vacancy->code, 
            //     'url' => "{$baseUrl}/admin/enrollment"
            // ];
            
            // foreach ($admin as $user) {
            //     $smsData['to'] = $user->number;
            //     $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_admin');
            // }
            return $result;
        } catch (\Exception $e) {
            Log::error('An error occurred during enrollment agreement: ' . $e->getMessage());
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
            Log::error('An error occurred during enrollment agreement: ' . $e->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }
    }
}

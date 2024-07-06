<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Staff;
use App\Models\Vacancy;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Candidate\AddUserRepository;
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
            $vacancy = Vacancy::findOrFail($data['data']['vacancy_id']);
            // return $vacancy;
            $initials = $vacancy->hr->name_ka;
            $parent_id = $vacancy->hr->parent_id;
            if ($type == 'vacancy') {
                $result = $this->enrollmentRepository->vacancy($data, $vacancy);
            }else{
                $author_id = $vacancy->hr->id;
                $registerLog = userRegisterLog::where('user_id', $data['data']['user_id'])->first();
                if ($registerLog) {
                    $author_id = $registerLog->creator_id;
                    $initials = $registerLog->creator->name_ka;
                    $parent_id = $registerLog->creator->parent_id;
                }
                $result = $this->enrollmentRepository->register($data['data'], $author_id);
            }
            $admin = Cache::rememberForever('admin_staff', function () {
                return Staff::where('role_id', 1)->get();
            });


            function sanitizeString($string) {
                return mb_convert_encoding($string, 'UTF-8', 'UTF-8');
            }
            $adminRecord = $admin->where('id', $parent_id)->first();
            $adminNumber = $adminRecord->number;
            $smsData = [
                'to' => $adminNumber,
                'hrInicial' => $initials,
                'money' => $data['data']['money'],
                'code'=> $vacancy->code,
                'url' => route('admin.enrollment')
            ];
            $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_admin');
            return $result;
        } catch (\Exception $e) {
            Log::error('An error occurred during enrollment save agreement: ' . $e->getMessage());
            throw new \Exception("An error occurred during enrollment save agreement: " . $e->getMessage(), 500);
        }
    }

    function registerFee($data) {
        try {
            $fee = RegistrationFee::where('user_id', $data['data']['user_id'])->first();
            if ($fee) {
                $author_id = $fee->creator_id;
                $initials = $fee->creator->name_ka;
                $parent_id = $fee->creator->parent_id;
            }else{
                $auth = Auth::guard('staff')->user();
                $parent_id = $auth->parent_id;
                if ($auth->role_id == 1) {
                    $parent_id = $auth->id;
                    $auth = Staff::where('role_id', 4)->where('parent_id', $parent_id)->where('is_active', 1)->inRandomOrder()->first();
                }
                $author_id = $auth->id;
                $initials = $auth->name_ka;

                $registrationFee = new AddUserRepository();
                $registrationFee->createRegistrationFee($data['data'], $data['data']['user_id'], $author_id);
            }
            $result = $this->enrollmentRepository->register($data['data'], $author_id);

            $admin = Cache::rememberForever('admin_staff', function () {
                return Staff::where('role_id', 1)->get();
            });
            $adminRecord = $admin->where('id', $parent_id)->first();
            $adminNumber = $adminRecord->number;
            $smsData = [
                'to' => $adminNumber,
                'hrInicial' => $initials,
                'money' => $data['data']['money'],
                // 'code'=> $vacancy->code,
                'url' => route('admin.enrollment')
            ];
            $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_admin');
            return $result;
        } catch (\Exception $e) {
            Log::error('An error occurred during enrollment agreement: ' . $e->getMessage());
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
            $user = Staff::where('id', $data['author_id'])->first();
            $smsData = ['to' => $user->number, 'money' => $data['money'], 'code'=> $data['vacancy']['code'], 'url' => route('admin.enrollment'),];
            $this->enrollmentRepository->sendSms($smsData, 'confirmed_enrollment_hr');
            return $result;
        } catch (\Exception $e) {
            Log::error('An error occurred during enrollment agreement: ' . $e->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $e->getMessage(), 500);
        }
    }
}

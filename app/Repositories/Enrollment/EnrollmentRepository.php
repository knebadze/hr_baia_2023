<?php

namespace App\Repositories\Enrollment;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\GlobalVariable;
use App\Models\userRegisterLog;
use Illuminate\Support\Facades\Log;
use App\Events\SmsNotificationEvent;

class EnrollmentRepository
{
    function vacancy($data, $vacancy) {
        try {
            $bonus_percent = $vacancy->hr->bonus_percent;

            $enrollment = new Enrollment([
                'enrollment_type' => 2,
                'author_id' => $vacancy->hr->user->id,
                'vacancy_id' => $data['data']->vacancy_id,
                'who_is_counting' => $data['data']->who_is_counting,
                'type' => $data['data']->type,
                'name' => $data['data']->name,
                'money' => $data['data']->money,
                'hr_percent' => $bonus_percent,
                'hr_bonus' => number_format((int)$data['data']->money * (int)$bonus_percent / 100, 2),
                'status_id' => 17,
            ]);

            if (isset($data['file'])) {
                $filePath = $data['file']->store('enrollment', 'public');
                $enrollment->file_path = $filePath;
            }

            $enrollment->save();

            return $enrollment;
        } catch (\Exception $e) {
            // Log the error message
            Log::error('An error occurred while creating the enrollment: ' . $e->getMessage());

            // Rethrow the exception
            throw $e;
        }
    }

    function register($data, $author_id ) {
        try {
            $user = User::where('id', $data['user_id'])->first();
            $paidBonus = GlobalVariable::where('name', 'registration_bonus')->first();
            $candidate_id = $user->candidate->id;
            $enrollment = new Enrollment();
            $enrollment->enrollment_type = 1;
            $enrollment->author_id  = $author_id;
            $enrollment->candidate_id = $candidate_id;
            $enrollment->type = $data['type'];
            $enrollment->name = $data['name'];
            $enrollment->money = $data['money'];
            $enrollment->status_id = 17;
            if ($data['type'] == 1) {
                $checkRegisterLog = userRegisterLog::where('user_id', $data['user_id'])->exists();
                $bonus = $checkRegisterLog ? $paidBonus->meaning / 2 : $paidBonus->meaning;
                $enrollment->hr_bonus = $bonus;
            }

            if (isset($data['file'])) {
                $filePath = $data['file']->store('enrollment', 'public');
            }
            if (isset($filePath)) {
                $enrollment->file_path = $filePath;
            }
            $enrollment->save();
            return $enrollment;
        } catch (\Exception $e) {
            // Log the error message
            Log::error($e->getMessage());

            // You can also re-throw the exception if you want it to be handled by a higher level exception handler
            throw $e;
        }
    }

    function sendSms($data, $name)
    {
        event(new SmsNotificationEvent($data, $name));
    }

}

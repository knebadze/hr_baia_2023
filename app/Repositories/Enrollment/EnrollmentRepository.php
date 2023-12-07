<?php

namespace App\Repositories\Enrollment;

use App\Models\User;
use App\Models\Vacancy;
use App\Models\Enrollment;
use App\Models\GlobalVariable;
use Illuminate\Support\Facades\Auth;

class EnrollmentRepository
{
    function vacancy($data, $vacancy) {

        $bonus_percent = $vacancy->hr->bonus_percent;
        $enrollment = new Enrollment();
        $enrollment->enrollment_type = 2;
        $enrollment->author_id  = $vacancy->hr_id;
        $enrollment->vacancy_id = $data['data']->vacancy_id;
        $enrollment->who_is_counting = $data['data']->who_is_counting;
        $enrollment->type = $data['data']->type;
        $enrollment->name = $data['data']->name;
        $enrollment->money = $data['data']->money;
        $enrollment->hr_percent = $bonus_percent;
        $enrollment->hr_bonus = number_format((int)$data['data']->money * (int)$bonus_percent / 100, 2);
        if (isset($data['file'])) {
            $filePath = $data['file']->store('enrollment', 'public');
        }
        if (isset($filePath)) {
            $enrollment->file_path = $filePath;
        }
        $enrollment->save();

        return $enrollment;
    }

    function register($data, $vacancy) {
        $user = User::where('id', $data['data']->user_id)->first();
        $paidBonus = GlobalVariable::where('name', 'paid_registration')->first();
        $candidate_id = $user->candidate->id;
        $enrollment = new Enrollment();
        $enrollment->enrollment_type = 1;
        $enrollment->author_id  = $vacancy->hr_id;
        $enrollment->candidate_id = $candidate_id;
        $enrollment->type = $data['data']->type;
        $enrollment->name = $data['data']->name;
        $enrollment->money = $data['data']->money;
        if ($data['data']->type == 1) {
            // აქ შეიძლება დაემატოს პროცენტული გამოთვლა
            $enrollment->hr_bonus = $paidBonus->meaning;
        }

        if (isset($data['file'])) {
            $filePath = $data['file']->store('enrollment', 'public');
        }
        if (isset($filePath)) {
            $enrollment->file_path = $filePath;
        }
        $enrollment->save();
        return $enrollment;
    }

}

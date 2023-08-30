<?php

namespace App\Repositories\Enrollment;

use App\Models\User;
use App\Models\Vacancy;
use App\Models\Enrollment;
use App\Models\userRegisterLog;
use App\Models\VacancyDeposit;
use Illuminate\Support\Facades\Auth;

class EnrollmentRepository
{
    function vacancy($data) {
        $vacancy = Vacancy::where('id', $data['data']->vacancy_id)->first();
        $bonus_percent = $vacancy->hr->bonus_percent;
        $enrollment = new Enrollment();
        $enrollment->enrollment_type = 2;
        $enrollment->author_id  = Auth::id();
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
        if ($data['data']->type == 1) {
            $this->depositUpdate($data['data']->id, $data['data']->who_is_counting);
        }
        return $enrollment;
    }
    function depositUpdate($id, $type) {
        if ($type == 1) {
            $result['data'] = VacancyDeposit::where('id', $id)->update(['must_be_enrolled_candidate' => 0, 'must_be_enrolled_candidate_date' => null]);
        }else{
            $result['data'] = VacancyDeposit::where('id', $id)->update(['must_be_enrolled_employer' => 0, 'must_be_enrolled_employer_date' => null]);
        }

    }

    function register($data) {
        // dd($data);
        $user = User::where('id', $data['data']->user_id)->first();
        $candidate_id = $user->candidate->id;
        $enrollment = new Enrollment();
        $enrollment->enrollment_type = 1;
        $enrollment->author_id  = Auth::id();
        $enrollment->candidate_id = $candidate_id;
        $enrollment->type = $data['data']->type;
        $enrollment->name = $data['data']->name;
        $enrollment->money = $data['data']->money;
        $enrollment->hr_bonus = 10;
        if (isset($data['file'])) {
            $filePath = $data['file']->store('enrollment', 'public');
        }
        if (isset($filePath)) {
            $enrollment->file_path = $filePath;
        }
        $enrollment->save();
        if ($data['data']->type == 1) {
            $this->registerLogUpdate($data['data']->id);
        }
        return $enrollment;
    }

    function registerLogUpdate($id) {
        return userRegisterLog::where('id', $id)->update(['enroll_date' => null, 'money' => 0]);
    }
}

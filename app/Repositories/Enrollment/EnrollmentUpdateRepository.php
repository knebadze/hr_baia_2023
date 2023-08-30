<?php

namespace App\Repositories\Enrollment;

use App\Models\Enrollment;
use App\Models\Vacancy;
use App\Models\VacancyDeposit;

class EnrollmentUpdateRepository
{
    function update($data) {
        return Enrollment::where('id', $data['id'])->update([
            'name' => $data['name'],
            'hr_percent' => $data['hr_percent'],
            'hr_bonus' => number_format((int)$data['money'] * (int)$data['hr_percent'] / 100, 2)
        ]);
    }

    function agree($data) {
        // dd($data);
        $update = Enrollment::where('id', $data['id'])->update([
            'agree' => 1
        ]);
        $this->checkVacancy($data);
        return $update;
    }

    function checkVacancy($data) {
        if (VacancyDeposit::where('vacancy_id', $data['vacancy_id'])->where('must_be_enrolled_employer', 0)->where('must_be_enrolled_candidate', 0)->exists()) {
            VacancyDeposit::where('vacancy_id', $data['vacancy_id'])->delete();
            Vacancy::where('id', $data['vacancy_id'])->update(['status_id', 4]);
        }
    }
}

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

    
}

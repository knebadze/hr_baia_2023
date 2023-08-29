<?php

namespace App\Repositories\Enrollment;

use App\Models\Enrollment;

class EnrollmentUpdateRepository
{
    function update($data) {
        return Enrollment::where('id', $data['id'])->update([
            'name' => $data['name'],
            'hr_percent' => $data['hr_percent'],
            'hr_bonus' => number_format((int)$data['money'] * (int)$data['hr_percent'] / 100, 2)
        ]);
    }

    function agree($id) {
        return Enrollment::where('id', $id)->update([
            'agree' => 1
        ]);
    }
}

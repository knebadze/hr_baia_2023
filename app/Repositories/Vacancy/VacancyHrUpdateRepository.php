<?php

namespace App\Repositories\Vacancy;

use App\Models\HrHasVacancy;
use App\Models\Vacancy;

class VacancyHrUpdateRepository
{

    function update($data) {
        // dd($data);
        Vacancy::where('id', $data['id'])->update(['hr_id' => $data['new_hr']['hr']['id']]);
        $find = HrHasVacancy::where('hr_id', $data['new_hr']['hr']['id'])->first();
        $find->update(['has_vacancy' => ($find->has_vacancy + 1)]);
        HrHasVacancy::where('hr_id', $data['hr']['id'])->update(['has_vacancy' => 0]);
        return [];
    }

}

<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\hrDailyWork;
use App\Models\HrHasVacancy;

class VacancyHrUpdateRepository
{

    function update($data) {
        // dd($data);
        $vacancy = Vacancy::where('id', $data['id'])->first();
        $vacancy->update(['hr_id' => $data['new_hr']['hr']['id']]);
        $find = HrHasVacancy::where('hr_id', $data['new_hr']['hr']['id'])->first();
        $find->update(['has_vacancy' => ($find->has_vacancy + 1)]);
        HrHasVacancy::where('hr_id', $data['hr']['id'])->update(['has_vacancy' => 0]);
        $this->dailyWorkEvent($data['new_hr']['hr']['id']);
        $this->lesHasVacancy($data['hr']['id'], $vacancy->created_at);
        return [];
    }

    function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }

    function lesHasVacancy($hr_id, $created_at) {
        $find = hrDailyWork::where('hr_id', $hr_id)->whereDate('created_at', $created_at)->first();
        $find->update(['has_vacancy' => $find->has_vacancy - 1]);
    }

}

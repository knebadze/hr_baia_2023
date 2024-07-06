<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\HrHasVacancy;
use App\Models\StaffDailyWork;
use App\Models\VacancyReminder;

class VacancyHrUpdateRepository
{

    function update($data) {
        $vacancy = Vacancy::where('id', $data['id'])->first();
        $vacancy->update(['hr_id' => $data['new_hr']['id']]);

        $findNewHr = HrHasVacancy::where('hr_id', $data['new_hr']['id'])->first();
        $findNewHr->update(['has_vacancy' => 1, 're_write' => $findNewHr->re_write + 1 ]);

        $findOldHr = HrHasVacancy::where('hr_id', $data['hr']['id'])->first();
        $findOldHr->update(['has_vacancy' => 0, 're_write' => $findOldHr->re_write - 1 ]);



        $this->dailyWorkEvent($data['new_hr']['id']);
        $this->lesHasVacancy($data['hr']['id'], $vacancy->created_at);
        $this->moveReminder($data['id'], $data['new_hr']['id']);
        return [];
    }

    public function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }

    public function lesHasVacancy($staff_id, $created_at) {
        $find = StaffDailyWork::where('staff_id', $staff_id)->whereDate('created_at', $created_at)->first();

        if ($find) {
            $find->decrement('has_vacancy', 1);
        }
    }

    public function moveReminder($vacancy_id, $hr_id) {
        VacancyReminder::where('vacancy_id', $vacancy_id)->where('active', 0)->update(['hr_id' => $hr_id]);
    }


}

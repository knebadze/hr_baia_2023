<?php

namespace App\Repositories\Vacancy;

use App\Models\Vacancy;
use App\Events\staffDailyJob;
use App\Models\HrHasVacancy;
use App\Models\StaffDailyWork;
use App\Models\VacancyReminder;

class VacancyHrUpdateRepository
{

    function update($data) {
        $vacancy = Vacancy::where('id', $data['id'])->first();
        $vacancy->update(['hr_id' => $data['new_hr']['id']]);

        $findNewHr = HrHasVacancy::where('hr_id', $data['new_hr']['id'])->first();
        if ($findNewHr) {
            $findNewHr->increment('re_write'); // Increment re_write by 1
            $findNewHr->increment('has_vacancy'); // Directly set has_vacancy to 1
        }

        $findOldHr = HrHasVacancy::where('hr_id', $data['hr']['id'])->first();
        if ($findOldHr) {
            $findOldHr->decrement('re_write'); // Decrement re_write by 1
            $findOldHr->decrement('has_vacancy'); // Directly set has_vacancy to 0
        }



        $this->dailyWorkEvent($data['new_hr']['id']);
        $this->lesHasVacancy($data['hr']['id'], $vacancy->created_at);
        $this->moveReminder($data['id'], $data['new_hr']['id']);
        return [];
    }

    public function dailyWorkEvent($hr_id) {
        event(new staffDailyJob($hr_id, 'has_vacancy'));
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

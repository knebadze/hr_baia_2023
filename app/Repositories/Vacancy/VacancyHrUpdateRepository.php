<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Events\hrDailyJob;
use App\Models\hrDailyWork;
use App\Models\HrHasVacancy;
use App\Models\RewriteHistory;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\Auth;

class VacancyHrUpdateRepository
{

    function update($data) {
        // dd($data);
        $vacancy = Vacancy::where('id', $data['id'])->first();
        $vacancy->update(['hr_id' => $data['new_hr']['hr']['id']]);

        $findNewHr = HrHasVacancy::where('hr_id', $data['new_hr']['hr']['id'])->first();
        $findNewHr->update(['has_vacancy' => 1, 're_write' => $findNewHr->re_write + 1 ]);

        $findOldHr = HrHasVacancy::where('hr_id', $data['hr']['id'])->first();
        $findOldHr->update(['has_vacancy' => 0, 're_write' => $findOldHr->re_write - 1 ]);


        $this->createHistory($vacancy->id, $data['hr']['id'], $data['new_hr']['hr']['id']);
        $this->dailyWorkEvent($data['new_hr']['hr']['id']);
        $this->lesHasVacancy($data['hr']['id'], $vacancy->created_at);
        $this->moveReminder($data['id'], $data['new_hr']['hr']['id']);
        return [];
    }

    public function dailyWorkEvent($hr_id) {
        event(new hrDailyJob($hr_id, 'has_vacancy'));
    }

    public function lesHasVacancy($hr_id, $created_at) {
        $find = hrDailyWork::where('hr_id', $hr_id)->whereDate('created_at', $created_at)->first();
        $find->update(['has_vacancy' => $find->has_vacancy - 1]);
    }

    public function moveReminder($vacancy_id, $hr_id) {
        VacancyReminder::where('vacancy_id', $vacancy_id)->where('active', 0)->update(['hr_id' => $hr_id]);
    }

    public function createHistory($vacancy_id, $old_hr_id, $new_hr_id) {
        $history = new RewriteHistory();
        $history->author_id = Auth::id();
        $history->vacancy_id = $vacancy_id;
        $history->old_hr_id = $old_hr_id;
        $history->new_hr_id = $new_hr_id;
        $history->save();
    }

}

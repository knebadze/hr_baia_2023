<?php

namespace App\Services\Admin;

use App\Models\Candidate;
use App\Models\DailyTask;
use App\Models\QualifyingCandidate;
use App\Models\Vacancy;
use App\Models\VacancyReminder;
use App\Models\WorkDay;
use Carbon\Carbon;

class DailyTaskService
{
    function task() {

        $quality = QualifyingCandidate::whereIn('qualifying_type_id', [5, 6, 7])->where('success', null)->whereDate('end_date', '<', Carbon::today())->get();

        if (count($quality)) {

            $ids = collect($quality)->pluck('id')->toArray();
            $vacancy_ids = collect($quality)->pluck('vacancy_id')->toArray();
            $candidate_ids = collect($quality)->pluck('candidate_id')->toArray();

            QualifyingCandidate::whereIn('id', $ids)->update(['success' => 1]);
            WorkDay::whereIn('qualifying_candidate_id', $ids)->delete();


            Vacancy::whereIn('id', $vacancy_ids)->update(['status_id' => 13]);
            VacancyReminder::whereIn('vacancy_id', $vacancy_ids)->where('date', '>', Carbon::today())->delete();

            Candidate::whereIn('id', $candidate_ids)->whereHas('qualifyingCandidate', function ($query) {
                return $query->whereIn('qualifying_type_id', [5, 6, 7])->where('success', null)->exists();
            })->update(['status_id' => 9]);


        }

        $daily = DailyTask::first();
        $daily->update(['date' => Carbon::today()->toDateString()]);
    }
}

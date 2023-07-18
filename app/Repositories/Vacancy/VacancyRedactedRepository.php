<?php

namespace App\Repositories\Vacancy;

use App\Models\Hr;
use Illuminate\Support\Facades\Auth;
use App\Models\VacancyRedactedHistory;

class VacancyRedactedRepository
{
    public function save($vacancy_id, $data) {
        $auth = Auth::User();
        $hr_id = Auth::User()->hr->id;
        foreach ($data as $key => $value) {
            $history = new VacancyRedactedHistory();
            $history->vacancy_id = $vacancy_id;
            $history->column_name = $key;
            $history->old_value =  json_encode($value);
            $history->hr_id = $hr_id;
            $history->save();
        }

    }
}

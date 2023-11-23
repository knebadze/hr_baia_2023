<?php

namespace App\Services\Admin;

use Carbon\Carbon;
use App\Models\WorkDay;
use App\Models\QualifyingCandidate;
use App\Models\Vacancy;

class MoveEndDateService
{
    function move($data) {
        $find = QualifyingCandidate::where('id', $data['id'])->first();
        if ($find->qualifying_type_id == 7) {
            $findWorkSchedule = WorkDay::where('qualifying_candidate_id', $find->id)->first();

            $this->workDay($find->id, $find->vacancy->work_schedule_id, $find->start_date, $data['end_date'], json_decode($findWorkSchedule->week_day));
        }

        $result = $find->update(['end_date' => $data['end_date']]);

        return $result;
    }

    function workDay($id, $work_schedule_id, $start_date, $end_date, $week_day) {
        // dd($week_day);
        $startDate = Carbon::parse($start_date); // Get start_date's date
        $later = Carbon::parse($end_date);

        $weekendDates = [];

        if ($work_schedule_id == 6) {
            // Loop through the dates between today and six months later
            while ($startDate->lt($later)) {
                if ($startDate->isWeekend()) {
                    $weekendDates[] = $startDate->format('Y-m-d');
                }
                $startDate->addDay();
            }
        }elseif ($work_schedule_id == 7 || $work_schedule_id == 9) {
            $arr = collect($week_day)->pluck('name_en')->toArray();
            while ($startDate <= $later) {
                $dayName = strtoupper($startDate->format('l'));
                $test[] = $dayName;
                if (in_array($dayName, $arr)) {
                    $weekendDates[] = $startDate->toDateString();
                }

                $startDate->addDay();
            }

        }elseif ($work_schedule_id == 8) {
            $weekendDates[] = $start_date;
        }
        // dd($startDate, $later, $weekendDates, $work_schedule_id);
        $findWorkSchedule = WorkDay::where('id', $id)->update(['work_day' => json_encode($weekendDates)]);
    }
}

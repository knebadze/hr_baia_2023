<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Candidate;
use App\Models\QualifyingCandidate;
use App\Models\WorkDay;
use Illuminate\Queue\Worker;

class AddVacancyPersonalRepository
{
    function add($data) {
        $qualifying = new QualifyingCandidate();
        $qualifying->vacancy_id = $data['vacancy_id'];
        $qualifying->qualifying_type_id = $data['type']['id'];
        $qualifying->candidate_id = $data['candidate_id'];
        if ($data['type']['id'] == 3) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
        }
        // if ($data['type']['id'] == 6) {
        //     $this->changeCandidateStatus($data['candidate_id']);
        // }
        $qualifying->save();
        return $qualifying;
    }

    // function addOrUpdate($data) {
    //     // dd($data);
    //     if ($data['type']['id'] == 3) {
    //         $qualifying = QualifyingCandidate::updateOrCreate(
    //             ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //             [
    //                 'qualifying_type_id '=> $data['type']['id'],
    //                 'interview_date' => $data['interview_date'],
    //                 'interview_place' => $data['interview_place']['id']
    //             ]
    //         );
    //     }

    //     if ($data['type']['id'] == 5) {
    //         $qualifying = QualifyingCandidate::updateOrCreate(
    //             ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //             [
    //                 'qualifying_type_id '=> $data['type']['id'],
    //                 'start_date' => $data['start_date'],
    //                 'end_date' => $data['end_date'],
    //             ]
    //         );
    //     }
    //     // dd($data['type']['id']);
    //     $qualifying = QualifyingCandidate::updateOrCreate(
    //         ['vacancy_id' => $data['vacancy_id'], 'candidate_id' => $data['candidate_id']],
    //         [
    //             'qualifying_type_id '=> $data['type']['id']
    //         ]
    //     );
    //     return $qualifying;
    // }
    function addArr($data) {
        foreach ($data['candidate_id'] as $key => $value) {
            $qualifying = new QualifyingCandidate();
            $qualifying->vacancy_id = $data['vacancy_id'];
            $qualifying->qualifying_type_id = $data['type']['id'];
            $qualifying->candidate_id = $value;
            if ($data['type']['id'] == 3) {
                $qualifying->interview_date = $data['interview_date'];
                $qualifying->interview_place_id = $data['interview_place']['id'];
            }
            $qualifying->save();

        }
        return $qualifying;
    }

    function update($data) {
        $qualifying = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->first();
        $qualifying->qualifying_type_id = $data['type']['id'];
        if ($data['type']['id'] == 3) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
        }
        // if ($data['type']['id'] == 6) {
        //     $this->changeCandidateStatus($data['candidate_id'], $employ_type_id == null);
        // }
        $qualifying->update();
        return $qualifying;
    }
    function updateArr($data) {
        foreach ($data['candidate_id'] as $key => $value) {
            $qualifying = QualifyingCandidate::where('candidate_id', $value)->where('vacancy_id', $data['vacancy_id'])->first();
            $qualifying->qualifying_type_id = $data['type']['id'];
            if ($data['type']['id'] == 3) {
                $qualifying->interview_date = $data['interview_date'];
                $qualifying->interview_place_id = $data['interview_place']['id'];
            }
            if ($data['type']['id'] == 5) {
                $qualifying->start_date = $data['start_date'];
                $qualifying->end_date = $data['end_date'];
            }
            $qualifying->update();
        }

        return $qualifying;
    }
    function delete($data) {
        if (gettype($data['candidate_id']) == 'array') {
            $qualifying = QualifyingCandidate::whereIn('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->delete();
            return $qualifying;
        }
        if (QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->where('qualifying_type_id', 6)->exists()) {
            Candidate::where('id', $data['candidate_id'])->update(['status_id', 9]);
        }
        $qualifying = QualifyingCandidate::where('candidate_id', $data['candidate_id'])->where('vacancy_id', $data['vacancy_id'])->delete();
        return $qualifying;
    }

    function wasEmployed($data){
        // dd($data);
        $qualifying = QualifyingCandidate::updateOrCreate(
            ['candidate_id' => $data['candidate_id'], 'vacancy_id' => $data['vacancy']['id']],
            [
                'qualifying_type_id' => $data['employ_type']['id'],
                'start_date' => $data['vacancy']['start_date'],
                'end_date' => $this->endDay($data['vacancy']['term'], $data['vacancy']['start_date'])
            ]
        );
        // dd($data);
        $this->changeCandidateStatus($data['candidate_id'], $data['employ_type']['id']);
        if ($data['employ_type']['id'] == 7) {
            $this->workDay($qualifying->id, $data['vacancy']['work_schedule_id'], $data['vacancy']['start_date'], $data['vacancy']['term'], $data['week_day']);
        }

        return $qualifying;
    }

    function changeCandidateStatus($candidate_id, $employ_type_id)  {
        if ($employ_type_id == 7) {
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 11]);
        }else{
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 10]);
        }

    }

    function workDay($id, $work_schedule_id, $start_date, $term, $week_day) {

        $startDate = Carbon::parse($start_date); // Get today's date
        switch ($term['type']) {
            case 'Y':
                // Code for 'Y' type
                $later = $startDate->copy()->addYears($term['number']);
                break;
            case 'M':
                // Code for 'M' type
                $later = $startDate->copy()->addMonths($term['number']);
                break;
            case 'W':
                // Code for 'W' type
                $later = $startDate->copy()->addWeeks($term['number']);
                break;
            case 'D':
                // Code for 'D' type
                $later = $startDate->copy()->addDays($term['number']);
                break;
            default:
                // Default code if none of the cases match
                break;
        }
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

            while ($startDate->year <= $later->year) {
                $dayName = strtoupper($startDate->format('l'));

                if (in_array($dayName, $arr)) {
                    $weekendDates[] = $startDate->toDateString();
                }

                $startDate->addDay();
            }
        }elseif ($work_schedule_id == 8) {
            $weekendDates[] = $start_date;
        }

        $workDay = new WorkDay();
        $workDay->qualifying_candidate_id = $id;
        $workDay->work_day = json_encode($weekendDates);
        $workDay->save();
    }

    function endDay($term, $start_date) {
        $end_date = '';
        $startDateTime = Carbon::parse($start_date);
        $startDate = $startDateTime->addDays(1);
        switch ($term['type']) {
            case 'Y':
                // Code for 'Y' type
                $end_date = $startDate->addYears($term['number'])->toDateString();
                break;
            case 'M':
                // Code for 'M' type
                $end_date = $startDate->addMonths($term['number'])->toDateString();
                break;
            case 'W':
                // Code for 'W' type
                $end_date = $startDate->addWeeks($term['number'])->toDateString();
                break;
            case 'D':
                // Code for 'D' type
                $end_date = $startDate->addDays($term['number'])->toDateString();
                break;
            default:
                // Default code if none of the cases match
                break;
        }
        return $end_date;
    }
}

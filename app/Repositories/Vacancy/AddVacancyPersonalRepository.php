<?php

namespace App\Repositories\Vacancy;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\WorkDay;
use App\Models\Candidate;
use App\Events\hrDailyJob;
use Illuminate\Queue\Worker;
use App\Models\GlobalVariable;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;
use App\Models\QualifyingCandidate;

class AddVacancyPersonalRepository
{
    function add($data) {
        // dd($data['start_date']);
        $qualifying = new QualifyingCandidate();
        $qualifying->vacancy_id = $data['vacancy_id'];
        $qualifying->qualifying_type_id = $data['type']['id'];
        $qualifying->candidate_id = $data['candidate_id'];
        if ($data['type']['id'] == 4) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
            $reminderText = 'კანდიდატი (ID: '.$data['candidate_id'].') შევიდა გასაუბრებაზე, უნდა გადავამოწმო როგორ ჩაიარა გასაუბრებამ';
            $carbonDate = Carbon::parse($data['interview_date']);
            $modifiedDate = $carbonDate->addHour();
            $reminderData = $modifiedDate->format('Y-m-d H:i:s');
            $this->addReminder($data['vacancy_id'], $reminderData, $reminderText );
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
            $reminderText = 'კანდიდატი (ID: '.$data['candidate_id']. ')შევიდა გამოსაცდელი ვადით, უნდა გადავამოწმო იმყოფება თუ არაა სამუშაო ადგილზე';
            $reminderData = $data['start_date'];

            // Create a Carbon instance from the date
            $reminderDataCarbon = Carbon::parse($reminderData);

            // Set the time to '12:00:00'
            $reminderDataCarbon->setTime(12, 0, 0);
            $this->addReminder($data['vacancy_id'], $reminderDataCarbon, $reminderText);
            $this->changeCandidateStatus($data['candidate_id'], $data['type']['id']);
            $this->dailyWorkEvent($data['vacancy_id']);
        }
        $qualifying->save();
        return $qualifying;
    }


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
        $qualifying->status_id = null;
        if ($data['type']['id'] == 3) {
            $qualifying->interview_date = $data['interview_date'];
            $qualifying->interview_place_id = $data['interview_place']['id'];
            $reminderText = 'კანდიდატი (ID: '.$data['candidate_id'].') შევიდა გასაუბრებაზე, უნდა გადავამოწმო როგორ ჩაიარა გასაუბრებამ';
            $carbonDate = Carbon::parse($data['interview_date']);
            $modifiedDate = $carbonDate->addHour();
            $reminderData = $modifiedDate->format('Y-m-d H:i:s');
            $this->addReminder($data['vacancy_id'], $reminderData, $reminderText );
        }
        if ($data['type']['id'] == 5) {
            $qualifying->start_date = $data['start_date'];
            $qualifying->end_date = $data['end_date'];
            $reminderText = 'კანდიდატი (ID: '.$data['candidate_id']. ')შევიდა გამოსაცდელი ვადით, უნდა გადავამოწმო იმყოფება თუ არაა სამუშაო ადგილზე';
            $reminderData = $data['start_date'];

            // Create a Carbon instance from the date
            $reminderDataCarbon = Carbon::parse($reminderData);

            // Set the time to '12:00:00'
            $reminderDataCarbon->setTime(12, 0, 0);
            $this->addReminder($data['vacancy_id'], $reminderDataCarbon, $reminderText);
            $this->changeCandidateStatus($data['candidate_id'], $data['type']['id']);
            $this->dailyWorkEvent($data['vacancy_id']);
        }
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
            // if ($data['type']['id'] == 5) {
            //     $qualifying->start_date = $data['start_date'];
            //     $qualifying->end_date = $data['end_date'];
            // }
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
    // როცა კადრი დასაქმდა
    function wasEmployed($data){
        // dd($data);
        $end_date = $this->endDay($data['vacancy']['term'], $data['vacancy']['start_date']);
        $qualifying = QualifyingCandidate::updateOrCreate(
            ['candidate_id' => $data['candidate_id'], 'vacancy_id' => $data['vacancy']['id']],
            [
                'qualifying_type_id' => $data['employ_type']['id'],
                'start_date' => $data['vacancy']['start_date'],
                'end_date' => $end_date,
                'status_id' => null,
            ]
        );
        $this->changeCandidateStatus($data['candidate_id'], $data['employ_type']['id']);
        $this->addRegistrationFee($data['candidate_id'], $data['vacancy']['id']);
        if ($data['employ_type']['id'] == 7) {
            $this->workDay($qualifying->id, $data['vacancy']['work_schedule_id'], $data['vacancy']['start_date'], $data['vacancy']['term'], $data['week_day']);
        }
        $this->employedDailyWorkEvent($data['vacancy']['id']);
        // if ($data['employ_type']['id'] == 7 || $data['employ_type']['id'] == 6) {
        //     $endDate = Carbon::parse($end_date);
        //     $endDate = $endDate->subDay(2)->toDateString();
        //     $this->addReminder($data['vacancy']['id'], $endDate, 'ვაკნსიას ეწურება ვადა!!! უნდა დავურეკო დამკვეთს');
        // }
        return $qualifying;
    }

    function changeCandidateStatus($candidate_id, $employ_type_id)  {
        if ($employ_type_id == 7) {
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 11]);
        }else if($employ_type_id == 6){
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 10]);
        }else if($employ_type_id == 5){
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 14]);
        }

    }

    function addRegistrationFee($candidate_id, $vacancy_id){
        // ვამოწმებ აქვს თუ არაა თანხა გადახდილი
        // ვამოწმებ რომელიმე ჰრ ის დასაქმებული ხო არაა
        // თუ არის ბონუსი ეკუთვნის მას
        // თუ არა ბონუსი ეკუთვნის ვაკანსია რომელ ეიჩარსაც აწერია
        if (Candidate::where('id', $candidate_id)->where('registration_fee', 0)->exists()) {
            $candidate = Candidate::where('id', $candidate_id)->first();
            if (userRegisterLog::where('user_id', $candidate->user->id)->exists()) {
                $log = userRegisterLog::where('user_id', $candidate->user->id)->first();
                $creator_id = $log->creator_id;
            }else{
                $vacancy = Vacancy::where('id', $vacancy_id)->first();
                $creator_id = $vacancy->hr->user->id;
            }
            // if (RegistrationFee::where('user_id', $candidate->user->id)->exists()) {
                $paidBonus = GlobalVariable::where('name', 'paid_registration')->first();
                $date = Carbon::now()->addDays(7)->toDateString();
                $fee = RegistrationFee::create([
                    'user_id' => $candidate->user->id,
                    'initial_amount' => $paidBonus->meaning,
                    'money' => $paidBonus->meaning,
                    'creator_id' => $creator_id,
                    'enroll_date' => $date,
                ]);
            // }
        }

    }

    function workDay($id, $work_schedule_id, $start_date, $term, $week_day) {
        // dd($week_day);
        $startDate = Carbon::parse($start_date); // Get start_date's date
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
        $workDay = new WorkDay();
        $workDay->qualifying_candidate_id = $id;
        $workDay->work_day = json_encode($weekendDates);
        $workDay->week_day = json_encode($week_day);
        $workDay->save();
    }

    function endDay($term, $start_date) {
        $end_date = '';
        $startDate = Carbon::parse($start_date);
        $startDate = $startDate->subDay(1);
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

    function addReminder($vacancy_id, $date, $text) {
        $find = Vacancy::where('id',$vacancy_id)->first();
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $vacancy_id;
        $reminder->hr_id = $find->hr_id;
        $reminder->date = $date;
        $reminder->reason = $text;
        $reminder->save();
    }

    function dailyWorkEvent($vacancy_id) {
        $vacancy = Vacancy::where('id', $vacancy_id)->first();
        event(new hrDailyJob($vacancy->hr_id, 'has_probationary_period'));
    }

    function employedDailyWorkEvent($vacancy_id) {
        $vacancy = Vacancy::where('id', $vacancy_id)->first();
        event(new hrDailyJob($vacancy->hr_id, 'employed'));
    }
}

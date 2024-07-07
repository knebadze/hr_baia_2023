<?php

namespace App\Repositories\Vacancy;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\WorkDay;
use App\Models\Candidate;
use App\Events\staffDailyJob;
use App\Models\GlobalVariable;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use App\Models\QualifyingCandidate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\Events\SmsNotificationEvent;
use Illuminate\Support\Facades\Auth;

class AddVacancyPersonalRepository
{
    
    function add($data) {
        DB::beginTransaction(); // Start a new database transaction
        try {
            $qualifying = new QualifyingCandidate();
            $qualifying->fill([
                'vacancy_id' => $data['vacancy_id'],
                'qualifying_type_id' => $data['type']['id'],
                'candidate_id' => $data['candidate_id'],
                'status_id' => 17, // Default status, assuming it's always set to 17 in your cases
            ]);

            switch ($data['type']['id']) {
                case 4:
                    $this->handleInterviewType($qualifying, $data);
                    break;
                case 5:
                    $this->handleApprovalType($qualifying, $data);
                    break;
                case 6:
                    $this->handleProbationaryPeriodType($qualifying, $data);
                    break;
            }

            $qualifying->save();
            if ($data['type']['id'] != 3) {
                $this->sendSms($qualifying);
            }

            DB::commit(); // Commit the transaction

            return $qualifying;
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            Log::error("Error adding qualifying candidate: " . $e->getMessage());
            throw $e; // Rethrow the exception after rolling back
        }
    }
    function update($data) {
        DB::beginTransaction();
        try {
            $qualifying = QualifyingCandidate::where('candidate_id', $data['candidate_id'])
                                              ->where('vacancy_id', $data['vacancy_id'])
                                              ->first();
            if (!$qualifying) {
                // Handle the case where the qualifying candidate is not found
                // For example, throw a custom exception or return a specific response
                throw new \Exception("Qualifying candidate not found.");
            }

            $qualifying->qualifying_type_id = $data['type']['id'];
            $status = null;

            switch ($data['type']['id']) {
                case 4:
                    $this->handleInterviewType($qualifying, $data);
                    break;
                case 5:
                    $status = 17;
                    $this->handleApprovalType($qualifying, $data);
                    break;
                case 6:
                    $status = 17;
                    $this->handleProbationaryPeriodType($qualifying, $data);
                    break;
            }

            // If status is set, update it
            if ($status !== null) {
                $qualifying->status_id = $status;
            }

            $qualifying->save();
            DB::commit(); // Commit the transaction if everything is successful

            return $qualifying;
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an error
            Log::error("Error updating qualifying candidate: " . $e->getMessage());
            // Optionally, rethrow the exception or return a custom error response
            throw $e;
            // Or return a custom error response
            // return response()->json(['error' => 'An unexpected error occurred'], 500);
        }
    }

    private function handleInterviewType($qualifying, $data) {
        $qualifying->interview_date = $data['interview_date'];
        $qualifying->interview_place_id = $data['interview_place']['id'];
        $reminderText = "კანდიდატი (ID: {$data['candidate_id']}) შევიდა გასაუბრებაზე, უნდა გადავამოწმო როგორ ჩაიარა გასაუბრებამ";
        $reminderData = Carbon::parse($data['interview_date'])->addHour()->format('Y-m-d H:i:s');
        $this->addReminder($data['vacancy_id'], $reminderData, $reminderText);
    }

    private function handleApprovalType($qualifying, $data) {
        $qualifying->start_date = Carbon::now();
        $qualifying->end_date = Carbon::now()->addDays(5);
        $this->changeCandidateStatus($data['candidate_id'], $data['type']['id']);
        $this->dailyWorkEvent($data['vacancy_id'], 'approved_by_employer');
    }

    private function handleProbationaryPeriodType($qualifying, $data) {
        $qualifying->start_date = $data['start_date'];
        $qualifying->end_date = $data['end_date'];
        $reminderText = "კანდიდატი (ID: {$data['candidate_id']})შევიდა გამოსაცდელი ვადით, უნდა გადავამოწმო იმყოფება თუ არაა სამუშაო ადგილზე";
        $reminderData = Carbon::parse($data['start_date'])->setTime(12, 0)->format('Y-m-d H:i:s');
        $this->addReminder($data['vacancy_id'], $reminderData, $reminderText);
        $this->changeCandidateStatus($data['candidate_id'], $data['type']['id']);
        $this->dailyWorkEvent($data['vacancy_id'], 'has_probationary_period');
        $this->updateQualifying($data['vacancy_id']);
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
        DB::beginTransaction();
        try {
            $vacancy_id = $data['vacancy']['id'];
            $end_date = $this->endDay($data['vacancy']['term'], $data['vacancy']['start_date']);
            $qualifying = QualifyingCandidate::updateOrCreate(
                ['candidate_id' => $data['candidate_id'], 'vacancy_id' => $vacancy_id],
                [
                    'qualifying_type_id' => $data['employ_type']['id'],
                    'start_date' => $data['vacancy']['start_date'],
                    'end_date' => $end_date,
                    'status_id' => 17,
                ]
            );
            $this->changeCandidateStatus($data['candidate_id'], $data['employ_type']['id']);
            $this->addRegistrationFee($data['candidate_id'], $vacancy_id);
            if ($data['employ_type']['id'] == 8) {
                $this->workDay($qualifying->id, $data['vacancy']['work_schedule_id'], $data['vacancy']['start_date'], $data['vacancy']['term'], $data['week_day']);
            }
            $this->employedDailyWorkEvent($vacancy_id);
    
            DB::commit();
            return $qualifying;
        } catch (Exception $e) {
            DB::rollBack();
            // Handle the error, e.g., log it or return a custom error message
            // Log::error($e->getMessage());
            throw $e; // or return a response indicating failure
        }
    }

    function changeCandidateStatus($candidate_id, $employ_type_id)  {
        if ($employ_type_id == 8) {
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 11]);
        }else if($employ_type_id == 7){
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 10]);
        }else if($employ_type_id == 6){
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 14]);
        }else if($employ_type_id == 5){
            Candidate::where( 'id', $candidate_id )->update(['status_id'=> 15]);
        }

    }


    function addRegistrationFee($candidate_id, $vacancy_id){
           // ვამოწმებ აქვს თუ არაა თანხა გადახდილი
        // ვამოწმებ რომელიმე ჰრ ის დასაქმებული ხო არაა
        // თუ არის ბონუსი ეკუთვნის მას
        // თუ არა ბონუსი ეკუთვნის ვაკანსია რომელ ეიჩარსაც აწერია
        $candidate = Candidate::find($candidate_id);
        if ($candidate && $candidate->registration_fee == 0) {
            $log = userRegisterLog::where('user_id', $candidate->user->id)->first();
            if ($log) {
                $creator_id = $log->creator_id;
            } else {
                $vacancy = Vacancy::find($vacancy_id);
                $creator_id = $vacancy ? $vacancy->hr->id : null;
            }

            $paidBonus = GlobalVariable::where('name', 'paid_registration')->first();
            if ($paidBonus) {
                $date = Carbon::now()->addDays(7)->toDateString();
                $fee = RegistrationFee::updateOrCreate(
                    ['user_id' => $candidate->user->id],
                    [
                        'initial_amount' => $paidBonus->meaning,
                        'money' => $paidBonus->meaning,
                        'creator_id' => $creator_id,
                        'enroll_date' => $date,
                    ]
                );
            }
        }
    }

    function workDay($id, $work_schedule_id, $start_date, $term, $week_day) {
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

    function dailyWorkEvent($vacancy_id, $type) {
        $vacancy = Vacancy::where('id', $vacancy_id)->first();
        event(new staffDailyJob($vacancy->hr_id, $type));
    }

    function employedDailyWorkEvent($vacancy_id) {
        $vacancy = Vacancy::where('id', $vacancy_id)->first();
        event(new staffDailyJob($vacancy->hr_id, 'employed'));
    }

    private function getFirstName($fullName) {
        $parts = explode(' ', $fullName);
        return $parts[0];
    }

    function sendSms($qualifying)
    {
        $data = []; // Common data
        $employer_name = $qualifying->vacancy->employer->name_ka;
        $employer_number = $qualifying->vacancy->employer->number;
        $hr_name = $this->getFirstName($qualifying->vacancy->hr->name_ka);
        $hr_number = $qualifying->vacancy->hr->number;
        $candidate_name = $qualifying->candidate->user->name_ka;
        $candidate_number = $qualifying->candidate->user->number;

        switch ($qualifying->qualifying_type_id) {
            case 1:
                // $notificationType = 'will_think_candidate';
                // $data = [
                //     'to' => $candidate_number,
                //     'category' => $qualifying->vacancy->category->name_ka,
                //     'number' => $hr_number,
                //     'link' => route('job.detail', [
                //         'locale' => App::getLocale(),
                //         'id' => $qualifying->vacancy->id,
                //         'slug' => $qualifying->vacancy->slug,
                //     ]),
                // ];
                $notificationType = 'interested_candidate_employer';
                $data = [
                    'to' => $employer_number,
                    'link' => route('candidate.photo.questionnaire', [
                        'locale' => App::getLocale(),
                        'id' => $qualifying->id,
                    ]),
                ];
                break;

            case 2:
                $notificationType = 'interested_candidate_employer';
                $data = [
                    'to' => $employer_number,
                    'link' => route('candidate.photo.questionnaire', [
                        'locale' => App::getLocale(),
                        'id' => $qualifying->id,
                    ]),
                ];
                break;

            case 4:
                $notificationType = 'interview_period_employer';
                $data = [
                    'to' => $employer_number,
                    'dateTime' => $qualifying->interview_date,
                    'place' => $qualifying->interviewPlace->name_ka,
                    'cName' => $qualifying->interview_place_id != 2?$candidate_name:'',
                    'cNumber' => $qualifying->interview_place_id != 2?$candidate_number:'',
                    'name' => $hr_name,
                    'number' => $hr_number,
                    'link' => route('candidate-detail', [
                        'locale' => App::getLocale(),
                        'id' => $qualifying->candidate->id,
                    ])
                ];
                event(new SmsNotificationEvent($data, $notificationType));
                $data = [];

                $notificationType = 'interview_period_candidate';
                // $dateInCarbonFormat = Carbon::parse($qualifying->interview_date);
                $data = [
                    'to' => $candidate_number,
                    'dateTime' => $qualifying->interview_date,
                    'place' => $qualifying->interviewPlace->name_ka,
                    'eName' => $qualifying->interview_place_id != 2? $employer_name:'',
                    'eNumber' => $qualifying->interview_place_id != 2?$employer_number:'',
                    'name' => $hr_name,
                    'number' => $hr_number,
                    'link' => route('job.detail', [
                        'locale' => App::getLocale(),
                        'id' => $qualifying->vacancy->id,
                        'slug' => $qualifying->vacancy->slug
                    ])
                ];
                break;

            case 5:
                $notificationType = 'approved_by_employer';
                $data = [
                    'to' => $employer_number,
                    'name' => $hr_name,
                    'number' => $hr_number,
                    'link' => route('candidate-detail', [
                        'locale' => App::getLocale(),
                        'id' => $qualifying->candidate->id,
                    ]),
                ];
                break;

            case 6:
                // $notificationType = 'probation_period_candidate';
                // $data = [
                //     'to' => $candidate_number,
                //     'dateTime' => $qualifying->start_date.'-'.$qualifying->end_date,
                //     'cName' => $candidate_name,
                //     'cNumber' => $candidate_number,
                //     'name' => $hr_name,
                //     'number' => $hr_number,
                //     'link' => route('job.detail', [
                //         'locale' => App::getLocale(),
                //         'id' => $qualifying->vacancy->id,
                //         'slug' => $qualifying->vacancy->slug
                //     ])
                // ];
                // event(new SmsNotificationEvent($data, $notificationType));
                // $data = [];
                // Additional logic for case 5
                $notificationType = 'probation_period_employer';
                $data = [
                    'to' => $employer_number,
                    'name' => $employer_name,
                    'hName' => $hr_name,
                    'number' => $hr_number,
                ];
                break;

            // Additional cases can be added as needed

            default:
                // Handle the default case if needed
                break;
        }
        // dd($data, $notificationType);
        event(new SmsNotificationEvent($data, $notificationType));
    }

    function updateQualifying($vacancy_id) {
        // საჭიროებსს ესემესებს გაუქმების შესახებ
        try {
            DB::beginTransaction();

                // Update records for qualifying_type_id 4
                $interview = QualifyingCandidate::where('vacancy_id', $vacancy_id)
                    ->whereIn('qualifying_type_id', [4, 5])
                    ->where('status_id', 17)
                    ->pluck('id')->toArray();
                if (count($interview)) {
                    QualifyingCandidate::whereIn('vacancy_id', $interview)->update(['status_id' => 19]);
                    $text = 'შევიდა გასაუბრებაზე';
                    VacancyReminder::where('vacancy_id', $vacancy_id)->where('reason', 'LIKE', '%'.$text.'%')->update(['active' => 1]);
                }
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }

    }

}

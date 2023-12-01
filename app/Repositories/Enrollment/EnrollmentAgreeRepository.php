<?php

namespace App\Repositories\Enrollment;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Events\hrDailyJob;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;

class EnrollmentAgreeRepository
{
    function agree($data) {
        // dd($data);

        try {
            $enrollment = Enrollment::where('id', $data['id'])->first();
            $enrollment->update([
                'agree' => 1
            ]);
            if ($data['enrollment_type'] == 2) {
                //ვაკანსიის ჩარიცხვა
                $updateVacancyDeposit = $this->updateVacancyDeposit($data['vacancy_id'], $data['who_is_counting'], $data['type'], $data['money']);
                // dd('$hello');
                $updateVacancyDeposit && $this->checkVacancy($data['vacancy_id']);
                $this->dailyWorkEvent($data['author_id'], 'v');


            }else{
                //რეგისტრაცისს ჩარიცხვა
                $this->updateRegisterFee($data['candidate_id'], $data['type'], $data['money']);
                $this->dailyWorkEvent($data['author_id'], 'c');

            }
            $this->addHrBonus($data['enrollment_type'], $data['author_id'], $data['hr_bonus']);

            return $enrollment;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }


    }

    function updateVacancyDeposit($vacancy_id, $who_is_counting, $type, $money){
        try {
            $deposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->first();

            if ($type == 0) {
                //არასრული ჩარიცხვა
                if ($who_is_counting == 1) {
                    //კანდიდატის ჩარიცხვა
                    $deposit->update([
                        'must_be_enrolled_candidate' => (int)$deposit->must_be_enrolled_candidate - (int)$money
                    ]);
                }else{
                    //დამსაქმებლის ჩარიცხვა
                    $deposit->update([
                        'must_be_enrolled_employer' => (int)$deposit->must_be_enrolled_employer - (int)$money
                    ]);
                }

            }else{
                //სრული ჩარიცხვა
                if ($who_is_counting == 1) {
                    //კანდიდატის ჩარიცხვა
                    $deposit->update([
                        'must_be_enrolled_candidate' => 0,
                        'must_be_enrolled_candidate_date' => null
                    ]);
                }else{
                    //დამსაქმებლის ჩარიცხვა
                    $deposit->update([
                        'must_be_enrolled_employer' => 0,
                        'must_be_enrolled_employer_date' => null
                    ]);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
            return false;
        }


        return true;
    }

    function checkVacancy($vacancy_id) {
        if (VacancyDeposit::where('vacancy_id', $vacancy_id)->where('must_be_enrolled_employer', 0)->where('must_be_enrolled_candidate', 0)->exists()) {
            // VacancyDeposit::where('vacancy_id', $vacancy_id)->delete();
            Vacancy::where('id', $vacancy_id)->update(['status_id' => 4]);
            $this->deleteReminder($vacancy_id);
            $this->deleteDeposit($vacancy_id);

        }
    }

    function updateRegisterFee($candidate_id, $type, $money) {
        $candidate = Candidate::where('id', $candidate_id)->first();
        $register = RegistrationFee::where('user_id', $candidate->user->id)->first();
        if ($type == 0) {
            //არასრული ჩარიცხვა
            $register->update([
                'money' => (int)$register->money - (int)$money
            ]);
        }else{
            $register->update([
                'money' => 0,
                'enroll_date' => null
            ]);
            $candidate->update(['registration_fee' => 1]);
        }
    }

    function addHrBonus($type, $id, $bonus) {
        try {
            $user = User::where('id', $id)->first();
            $salary = Salary::where('hr_id', $user->hr->id)->where('hr_agree', 0)->whereNull('disbursement_date')->first();
            if ($type == 2) {
                $salary->update([
                    'hr_bonus_from_vacancy' => $salary->hr_bonus_from_vacancy + $bonus,
                    'full_salary' => $salary->full_salary + $bonus
                ]);
            }else{
                $salary->update([
                    'hr_bonus_from_registration' => $salary->hr_bonus_from_registration + $bonus,
                    'full_salary' => $salary->full_salary + $bonus
                ]);
            }
            return $salary;
        } catch (\Throwable $th) {
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }



    }

    function deleteReminder($vacancyId)  {
        if (VacancyReminder::where('vacancy_id', $vacancyId)->exists()) {
                VacancyReminder::where('vacancy_id', $vacancyId)->whereDate('date', '>', Carbon::now()->toDateTimeString())->where('active', 0)->delete();
        }
    }

    function deleteDeposit($vacancyId) {
        return VacancyDeposit::where('vacancy_id', $vacancyId)->delete();
    }

    function dailyWorkEvent($user_id, $type) {
        $user = User::where('id', $user_id)->first();
        $eventType = ($type == 'v') ? 'has_enrollment_vacancy' : 'has_enrollment_register';
        event(new hrDailyJob($user->hr->id, $eventType));
    }
}

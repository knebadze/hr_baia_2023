<?php

namespace App\Repositories\Enrollment;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\Candidate;
use App\Events\hrDailyJob;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use App\Models\userRegisterLog;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Salary\DisbursementOfSalaryRepository;

class EnrollmentAgreeRepository
{
    const TYPE_PARTIAL = 0;
    const WHO_IS_COUNTING_CANDIDATE = 1;
    const STATUS_CLOSED = 4;
    const REGISTRATION_FEE_PAID = 1;

    function agree($data) {
        // Start a new database transaction
        DB::beginTransaction();

        try {
            $enrollment = Enrollment::where('id', $data['id'])->first();
            $enrollment->update([
                'agree' => 1
            ]);

            if ($data['enrollment_type'] == 2) {
                $updateVacancyDeposit = $this->updateVacancyDeposit($data['vacancy_id'], $data['who_is_counting'], $data['type'], $data['money']);
                $updateVacancyDeposit && $this->checkVacancy($data['vacancy_id']);
                $this->dailyWorkEvent($data['author_id'], 'v');
            } else {
                $this->updateRegisterFee($data['candidate_id'], $data['type'], $data['money']);
                $this->updateCandidateFeeStatus($data['candidate_id']);
                $this->dailyWorkEvent($data['author_id'], 'c');
            }
            $staff = Staff::where('id', $data['author_id'])->firstOrFail();
            $this->addHrBonus($data['enrollment_type'], $staff->id, $data['hr_bonus']);

            // If we reach here, it means that no exceptions were thrown
            // We can commit the transaction
            DB::commit();

            return $enrollment;
        } catch (\Throwable $th) {
            // An error occurred, we need to rollback the transaction
            DB::rollBack();

            Log::error('An error occurred during enrollment agreement agree: ' . $th->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }



    function updateVacancyDeposit($vacancy_id, $who_is_counting, $type, $money){

        DB::beginTransaction();

        try {
            $deposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->firstOrFail();

            if ($type == self::TYPE_PARTIAL) {
                $fieldToUpdate = $who_is_counting == self::WHO_IS_COUNTING_CANDIDATE ? 'must_be_enrolled_candidate' : 'must_be_enrolled_employer';
                $deposit->update([
                    $fieldToUpdate => (int)$deposit->$fieldToUpdate - (int)$money
                ]);
            } else {
                $fieldToUpdate = $who_is_counting == self::WHO_IS_COUNTING_CANDIDATE ? 'must_be_enrolled_candidate' : 'must_be_enrolled_employer';
                $deposit->update([
                    $fieldToUpdate => 0,
                    $fieldToUpdate . '_date' => null
                ]);
            }

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('An error occurred during enrollment agreement updateVacancyDeposit: ' . $th->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }
    // function updateVacancyDeposit($vacancy_id, $who_is_counting, $type, $money){
    //     try {
    //         $deposit = VacancyDeposit::where('vacancy_id', $vacancy_id)->first();

    //         if ($type == 0) {
    //             //არასრული ჩარიცხვა
    //             if ($who_is_counting == 1) {
    //                 //კანდიდატის ჩარიცხვა
    //                 $deposit->update([
    //                     'must_be_enrolled_candidate' => (int)$deposit->must_be_enrolled_candidate - (int)$money
    //                 ]);
    //             }else{
    //                 //დამსაქმებლის ჩარიცხვა
    //                 $deposit->update([
    //                     'must_be_enrolled_employer' => (int)$deposit->must_be_enrolled_employer - (int)$money
    //                 ]);
    //             }

    //         }else{
    //             //სრული ჩარიცხვა
    //             if ($who_is_counting == 1) {
    //                 //კანდიდატის ჩარიცხვა
    //                 $deposit->update([
    //                     'must_be_enrolled_candidate' => 0,
    //                     'must_be_enrolled_candidate_date' => null
    //                 ]);
    //             }else{
    //                 //დამსაქმებლის ჩარიცხვა
    //                 $deposit->update([
    //                     'must_be_enrolled_employer' => 0,
    //                     'must_be_enrolled_employer_date' => null
    //                 ]);
    //             }
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error('An error occurred during enrollment agreement updateVacancyDeposit: ' . $th->getMessage());
    //         throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
    //         return false;
    //     }


    //     return true;
    // }


    function checkVacancy($vacancy_id) {
        $deposit = VacancyDeposit::firstWhere([
            ['vacancy_id', '=', $vacancy_id],
            ['must_be_enrolled_employer', '=', 0],
            ['must_be_enrolled_candidate', '=', 0]
        ]);

        if (!$deposit) {
            return;
        }

        Vacancy::where('id', $vacancy_id)->update(['status_id' => self::STATUS_CLOSED]);
        $this->deleteReminder($vacancy_id);
        $this->deleteDeposit($vacancy_id);
    }

    function updateCandidateFeeStatus ($candidate_id) {
        try {
            $candidate = Candidate::where('id', $candidate_id)->firstOrFail();
            $candidate->update(['registration_fee' => 1]);
        } catch (\Exception $e) {
            Log::error('An error occurred during candidate status update: ' . $e->getMessage());
            throw new \Exception("An error occurred during candidate status update: " . $e->getMessage(), 500);
        }
    }

    function updateRegisterFee($candidate_id, $type, $money) {
        try {
            $candidate = Candidate::where('id', $candidate_id)->firstOrFail();
            $register = RegistrationFee::where('user_id', $candidate->user->id)->firstOrFail();

            if ($type != self::TYPE_PARTIAL) {
                $register->update([
                    'money' => 0,
                    'enroll_date' => null
                ]);
                $candidate->update(['registration_fee' => self::REGISTRATION_FEE_PAID]);
                return;
            }

            $register->update([
                'money' => (int)$register->money - (int)$money
            ]);
        } catch (\Exception $e) {
            Log::error('An error occurred during registration fee update: ' . $e->getMessage());
            throw new \Exception("An error occurred during registration fee update: " . $e->getMessage(), 500);
        }
    }


    function addHrBonus($type, $id, $bonus) {
        try {
            $salary = Salary::where('staff_id', $id)->where('staff_agree', 0)->whereNull('disbursement_date')->first();
            $bonusField = $type == 2 ? 'staff_bonus_from_vacancy' : 'staff_bonus_from_registration';

            if (!$salary){
                $createSalary = new DisbursementOfSalaryRepository();
                $salary = $createSalary->createSalary($id);
            }

            $salary->update([
                $bonusField => $salary->$bonusField + $bonus,
                'full_salary' => $salary->full_salary + $bonus
            ]);

            return $salary;
        } catch (\Throwable $th) {
            Log::error('An error occurred during enrollment agreement addHrBonus: ' . $th->getMessage());
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }
    }

    function deleteReminder($vacancyId)  {
        VacancyReminder::where('vacancy_id', $vacancyId)
            ->whereDate('date', '>', Carbon::now()->toDateTimeString())
            ->where('active', 0)
            ->delete();
    }

    function deleteDeposit($vacancyId) {
        return VacancyDeposit::where('vacancy_id', $vacancyId)->delete();
    }

    function dailyWorkEvent($staff_id, $type) {
        $staff = Staff::where('id', $staff_id)->first();
        $eventType = ($type == 'v') ? 'has_enrollment_vacancy' : 'has_enrollment_register';
        event(new hrDailyJob($staff->id, $eventType));
    }
}

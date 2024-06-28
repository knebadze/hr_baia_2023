<?php

namespace App\Repositories\Salary;

use App\Models\Hr;
use Carbon\Carbon;
use App\Models\Salary;
use App\Models\HrWorkLog;
use App\Models\Enrollment;
use App\Models\hrDailyWork;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DisbursementOfSalaryRepository
{
    function check($data) {
        $salary = Salary::latest()->first();
        // dd(Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->count());
        $check = (Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->exists())
            ? Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->count()
            : null;
        if ($check) {
            return ['type' => 'w', 'checkCount' => $check];
        } else {
            return $this->action($data);

        }
    }

    function action($data) {
        // dd($data);
        // Start transaction
        DB::beginTransaction();
    
        try {
            $ids = collect($data)->pluck('id')->toArray();
           
            $salary = Salary::orderBy('hr_id', 'ASC')->whereIn('id', $ids)->update(['disbursement_date' => Carbon::now()]);
            // Create new salary records
            foreach ($data as $value) {
                $this->createSalary($value['hr_id']);
            }
            $this->addWorkLog($ids);
    
            if ($salary) {
                // Delete zero-value vacancy deposits
                VacancyDeposit::where('must_be_enrolled_employer', 0)->where('must_be_enrolled_candidate', 0)->delete();
                // Delete zero-value registration fees
                RegistrationFee::where('money', 0)->delete();
    
                // Update status for all confirmed enrollments before the disbursement date
                Enrollment::where('agree', 1)
                          ->where('created_at', '<=', Carbon::now())
                          ->update(['status_id' => 18]);
            }
    
            // Commit transaction
            DB::commit();
    
            return ['type' => 's', 'salary' => $salary];
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollback();
            throw new \Exception("An error occurred during disbursement agreement: " . $e->getMessage(), 500);
        } catch (\Throwable $th) {
            DB::rollback();
            throw new \Exception("An unexpected error occurred: " . $th->getMessage(), 500);
        }
    }

    function createSalary($staff_id) {
        try {
            $staff = Hr::where('id', $staff_id)->first();
            if (!$staff) {
                throw new \Exception("Staff with id {$staff_id} not found.", 404);
            }

            $salary = new Salary();
            $salary->hr_id = $staff->id;
            $salary->fixed_salary = $staff->fixed_salary;
            $salary->full_salary = $staff->fixed_salary;
            $salary->save();

            return $salary;
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error creating salary: ' . $e->getMessage());

            // You can decide what to return in case of error
            return null;
        }
    }

    function addWorkLog($ids) {

        try {
            $salary = Salary::orderBy('hr_id', 'ASC')->whereIn('id', $ids)->get();
            $hr_ids = collect($salary)->pluck('hr_id')->toArray();

            $start_date = $salary[0]->created_at;
            $end_date = $salary[0]->disbursement_date;
            $daily = hrDailyWork::whereIn('hr_id', $hr_ids)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->selectRaw('
                        hr_id,
                        SUM(has_vacancy) as total_has_vacancy,
                        SUM(employed) as total_employed,
                        SUM(has_probationary_period) as total_has_probationary_period,
                        SUM(has_enrollment_vacancy) as total_has_enrollment_vacancy,
                        SUM(candidate_has_registered) as total_candidate_has_registered,
                        SUM(has_enrollment_register) as total_has_enrollment_register
                    ')
                    ->groupBy('hr_id')
                    ->get();

            foreach ($daily as $key => $value) {
                $workLog = new HrWorkLog();
                $workLog->hr_id = $value->hr_id;
                $workLog->start_date = $start_date;
                $workLog->end_date = $end_date;
                $workLog->has_vacancy = $value->total_has_vacancy;
                $workLog->employed = $value->total_employed;
                $workLog->has_probationary_period = $value->total_has_probationary_period;
                $workLog->has_enrollment_vacancy = $value->total_has_enrollment_vacancy;
                $workLog->candidate_has_registered = $value->total_candidate_has_registered;
                $workLog->has_enrollment_register = $value->total_has_enrollment_register;
                $workLog->save();
            }
            // იშლება ყოველ დღიური სამუშაო პროცესის მონაცემი ჩაკომენტარებიულია დროეიბით
            // hrDailyWork::whereIn('hr_id', $hr_ids)->whereBetween('created_at', [$start_date, $end_date])->delete();
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception("An error occurred during addWorkLog agreement: " . $th->getMessage(), 500);
            dd($th);
        }


    }
}

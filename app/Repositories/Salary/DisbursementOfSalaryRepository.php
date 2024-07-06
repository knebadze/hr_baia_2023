<?php

namespace App\Repositories\Salary;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Vacancy;
use App\Models\Enrollment;
use App\Models\StaffWorkLog;
use App\Models\StaffDailyWork;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DisbursementOfSalaryRepository
{
    function check($data, $childView, $authId) {
        $salary = Salary::when($childView, function ($query) use ($authId) {
            $ids = $this->getStaffIds($authId);
            return $query->whereIn('staff_id', $ids);
        })->latest()->first();

        if (!$salary) {
            // Handle the case where no salary record is found
            // This could return a default action or error message
            return ['type' => 'error', 'message' => 'No salary record found'];
        }

        $count = Enrollment::when($childView, function ($query) use ($authId) {
                    $ids = $this->getStaffIds($authId);
                    return $query->whereIn('author_id', $ids);
                })
                ->whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())
                ->where('agree', 0)
                ->count();

        if ($count > 0) {
            return ['type' => 'w', 'checkCount' => $count];
        } else {
            return $this->action($data, $childView, $authId);
        }
    }

    function action($data, $childView, $authId) {
        // Start transaction
        DB::beginTransaction();

        try {
            $ids = collect($data)->pluck('id')->toArray();

            $salary = Salary::orderBy('staff_id', 'ASC')->whereIn('id', $ids)->update(['disbursement_date' => Carbon::now()]);
            // Create new salary records
            foreach ($data as $value) {
                $this->createSalary($value['staff_id']);
            }
            $this->addWorkLog($ids);

            if ($salary) {
               // Directly delete zero-value vacancy deposits without loading them into memory
                VacancyDeposit::whereHas('vacancy', function ($query) use ($ids) {
                            $query->whereIn('hr_id', $ids);
                        })->where('must_be_enrolled_employer', 0)
                        ->where('must_be_enrolled_candidate', 0)
                        ->delete();

                // Delete zero-value registration fees
                RegistrationFee::where('money', 0)
                            ->when($childView, function ($query) use ($authId) {
                                $creatorIds = $this->getStaffIds($authId);
                                return $query->whereIn('creator_id', $creatorIds);
                            })->delete();

                // Update status for all confirmed enrollments before the disbursement date
                Enrollment::where('agree', 1)
                        ->when($childView, function ($query) use ($authId) {
                            $authorIds = $this->getStaffIds($authId);
                            return $query->whereIn('author_id', $authorIds);
                        })
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
            $staff = Staff::where('id', $staff_id)->first();
            if (!$staff) {
                throw new \Exception("Staff with id {$staff_id} not found.", 404);
            }

            $salary = new Salary();
            $salary->staff_id = $staff->id;
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
        if (empty($ids)) {
            throw new \Exception("No IDs provided for addWorkLog.", 400);
        }

        try {
            $salary = Salary::orderBy('staff_id', 'ASC')
                        ->whereIn('id', $ids)
                        ->get();

            if ($salary->isEmpty()) {
                throw new \Exception("No Salary records found for the provided IDs.", 404);
            }

            $staff_ids = $salary->pluck('staff_id')->toArray();

            $start_date = $salary->first()->created_at;
            $end_date = $salary->first()->disbursement_date;

            $daily = StaffDailyWork::whereIn('staff_id', $staff_ids)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->selectRaw('
                        staff_id,
                        SUM(has_vacancy) as total_has_vacancy,
                        SUM(employed) as total_employed,
                        SUM(has_probationary_period) as total_has_probationary_period,
                        SUM(has_enrollment_vacancy) as total_has_enrollment_vacancy,
                        SUM(candidate_has_registered) as total_candidate_has_registered,
                        SUM(has_enrollment_register) as total_has_enrollment_register
                    ')
                    ->groupBy('staff_id')
                    ->get();

            $workLogs = $daily->map(function ($item) use ($start_date, $end_date) {
                return [
                    'staff_id' => $item->staff_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'has_vacancy' => $item->total_has_vacancy,
                    'employed' => $item->total_employed,
                    'has_probationary_period' => $item->total_has_probationary_period,
                    'has_enrollment_vacancy' => $item->total_has_enrollment_vacancy,
                    'candidate_has_registered' => $item->total_candidate_has_registered,
                    'has_enrollment_register' => $item->total_has_enrollment_register,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            StaffWorkLog::insert($workLogs);

        } catch (\Throwable $th) {
            // Consider logging the error here
            throw new \Exception("An error occurred during addWorkLog agreement: " . $th->getMessage(), 500);
        }
    }
    private function getStaffIds($parent_id) {
        return Staff::where('parent_id', $parent_id)->pluck('id');
    }
}

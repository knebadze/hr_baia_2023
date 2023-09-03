<?php

namespace App\Repositories\Salary;

use App\Models\Hr;
use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Enrollment;
use App\Models\RegistrationFee;
use App\Models\VacancyDeposit;

class DisbursementOfSalaryRepository
{
    function check($data) {
        $salary = Salary::latest()->first();
        // dd(Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->count());
        $check = (Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->exists())?Enrollment::whereDate('created_at', '>=', Carbon::parse($salary->created_at)->startOfDay()->toDateTimeString())->where('agree', 0)->count():null;
        if ($check) {
            return ['type' => 'w', 'checkCount' => $check];
        } else {
            return $this->action($data);

        }
    }

    function action($data) {
        // dd('action',$data);

        try {
            $ids = collect($data)->pluck('id')->toArray();
            $salary = Salary::whereIn('id', $ids)->update(['disbursement_date' => Carbon::now()]);
            //იქმნება ახალი ხელფასის ჩანაწერი
            foreach ($data as $key => $value) {
                $this->createSalary($value);
            }
            if($salary){
                // იშლება განულებული ჩარიცხვები
                if (VacancyDeposit::where('must_be_enrolled_employer', 0)->where('must_be_enrolled_candidate', 0)->exists()) {
                    VacancyDeposit::where('must_be_enrolled_employer', 0)->where('must_be_enrolled_candidate', 0)->delete();
                }
                // იშლება განულებული რეგისტრაციის გადახდები
                if (RegistrationFee::where('money', 0)->exists()) {
                    RegistrationFee::where('money', 0)->delete();
                }
            }
            return ['type' => 's', 'salary' => $salary];
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception("An error occurred during enrollment agreement: " . $th->getMessage(), 500);
        }

    }

    function createSalary($data) {
        $hr = Hr::where('id', $data['hr_id'])->first();
        // dd($hr);
        $salary = new Salary();
        $salary->hr_id = $hr->id;
        $salary->fixed_salary = $hr->fixed_salary;
        $salary->full_salary = $hr->fixed_salary;
        $salary->save();
        // Salary::create(
        //     ['hr_id' => $hr->id],
        //     ['fixed_salary'=> $hr->fixed_salary],
        //     ['full_salary' => $hr->fixed_salary]
        // );

    }
}

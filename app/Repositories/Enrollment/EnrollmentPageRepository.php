<?php

namespace App\Repositories\Enrollment;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Salary;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use App\Models\RegistrationFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnrollmentPageRepository
{
    function data()  {
        $enrolled = [];
        $salary = Salary::latest()->first();
        if ($salary) {
            $enrolled['items'] = Enrollment::where('enrollments.created_at', '>=', $salary->created_at)
                ->when(Auth::guard('staff')->user()->role_id !== 1, function ($query) {
                    return $query->where('enrollments.author_id', Auth::guard('staff')->id());
                })
                ->orderBy('agree', 'ASC')
                ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
                ->join('users', 'enrollments.author_id', '=', 'users.id')
                ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
                ->paginate(20);

            $enrolled['hr'] = Staff::where('role_id', 2)->whereNot('is_active', 2)->get()->toArray();
            $enrolled['start_date'] = $salary->created_at;
        }

        $mustBeEnrolled = [];

        $employer = VacancyDeposit::whereNotNull('must_be_enrolled_employer_date')
            ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
            ->join('staff', 'vacancies.hr_id', '=', 'hrs.id')
            ->select(
                'vacancy_deposits.id as record_id',
                'vacancies.code as id',
                'must_be_enrolled_employer as money',
                'must_be_enrolled_employer_date as date',
                'bonus_percent',
                'vacancy_deposits.updated_at as updated_at',
                DB::raw("'2' as type"),
                DB::raw("'2' as vacancy_type")
            );

        $candidate = VacancyDeposit::whereNotNull('must_be_enrolled_candidate_date')
            ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
            ->join('staff', 'vacancies.hr_id', '=', 'hrs.id')
            ->select(
                'vacancy_deposits.id as record_id',
                'vacancies.code as id',
                'must_be_enrolled_candidate as money',
                'must_be_enrolled_candidate_date as date',
                'bonus_percent',
                'vacancy_deposits.updated_at as updated_at',
                DB::raw("'2' as type"),
                DB::raw("'1' as vacancy_type")
            );

        $register = RegistrationFee::whereNot('money', 0)
            ->join('users', 'registration_fees.user_id', '=', 'users.id')
            ->join('candidates', 'users.id', '=', 'candidates.user_id')
            ->select(
                'registration_fees.id as record_id',
                'candidates.id as id',
                'money as money',
                'enroll_date as date',
                'creator_id',
                'registration_fees.updated_at as updated_at',
                DB::raw("'1' as type"),
                DB::raw("'0' as type")
            );

        $combinedQuery = $employer->union($candidate)->union($register);

        $combinedResults = VacancyDeposit::fromSub($combinedQuery, 'combined_query')
            ->get();


        $mustBeEnrolled['items'] = $combinedResults;

        return ['enrolled' => $enrolled, 'mustBeEnrolled' => $mustBeEnrolled];
    }


}

<?php

namespace App\Repositories\Enrollment;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\VacancyDeposit;
use App\Models\userRegisterLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnrollmentPageRepository
{
    function data()  {
        $currentMonth = Carbon::now()->format('m');
        $enrolled = [];

        $enrolled['items'] = Enrollment::whereMonth('enrollments.created_at', $currentMonth)
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('enrollments.author_id', Auth::id());
            })
            ->orderBy('agree', 'ASC')
            ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
            ->join('users', 'enrollments.author_id', '=', 'users.id')
            ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
            ->paginate(25);

        $enrolled['hr'] = User::where('role_id', 2)->whereNot('is_active', 2)->get()->toArray();

        $mustBeEnrolled = [];

        $employer = VacancyDeposit::whereNotNull('must_be_enrolled_employer_date')
            ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
            ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
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
            ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
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

        $register = userRegisterLog::where('type', 1)
            ->whereNot('money', 0)
            ->join('users', 'user_register_logs.user_id', '=', 'users.id')
            ->join('candidates', 'users.id', '=', 'candidates.user_id')
            ->select(
                'user_register_logs.id as record_id',
                'candidates.id as id',
                'money as money',
                'enroll_date as date',
                'creator_id',
                'user_register_logs.updated_at as updated_at',
                DB::raw("'1' as type"),
                DB::raw("'0' as type")
            );

        $combinedQuery = $employer->union($candidate)->union($register);

        $combinedResults = VacancyDeposit::fromSub($combinedQuery, 'combined_query')
            ->get();


        $mustBeEnrolled['items'] = $combinedResults;

        return ['enrolled' => $enrolled, 'mustBeEnrolled' => $mustBeEnrolled];
    }


    // function adminData()  {
    //     $currentMonth = Carbon::now()->format('m');
    //     $enrolled = [];
    //     $enrolled['items'] = Enrollment::whereMonth('enrollments.created_at', $currentMonth)
    //         ->orderBy('agree', 'ASC')
    //         ->leftJoin('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
    //         // ->leftJoin('candidates', 'enrollments.candidate_id', '=', 'candidates.id')
    //         ->join('users', 'enrollments.author_id', '=', 'users.id')
    //         ->select('enrollments.*', 'vacancies.code', 'users.name_ka',)
    //         ->paginate(25);


    //     $enrolled['role_id'] = Auth::user()->role_id;
    //     $enrolled['hr'] = User::where('role_id', 2)->whereNot('is_active', 2)->get()->toArray();


    //     $mustBeEnrolled = [];

    //     $employer = VacancyDeposit::whereNotNull('must_be_enrolled_employer_date')
    //         ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
    //         ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
    //         ->select(
    //             'vacancy_deposits.id as record_id',
    //             'vacancies.code as id',
    //             'must_be_enrolled_employer as money',
    //             'must_be_enrolled_employer_date as date',
    //             'bonus_percent',
    //             'vacancy_deposits.updated_at as updated_at',
    //             \DB::raw("'2' as type"),
    //             \DB::raw("'2' as vacancy_type")
    //         );

    //     $candidate = VacancyDeposit::whereNotNull('must_be_enrolled_candidate_date')
    //         ->leftJoin('vacancies', 'vacancy_deposits.vacancy_id', '=', 'vacancies.id')
    //         ->join('hrs', 'vacancies.hr_id', '=', 'hrs.id')
    //         ->select(
    //             'vacancy_deposits.id as record_id',
    //             'vacancies.code as id',
    //             'must_be_enrolled_candidate as money',
    //             'must_be_enrolled_candidate_date as date',
    //             'bonus_percent',
    //             'vacancy_deposits.updated_at as updated_at',
    //             \DB::raw("'2' as type"),
    //             \DB::raw("'1' as vacancy_type")
    //         );

    //     $register = userRegisterLog::where('type', 1)
    //         ->whereNot('money', 0)
    //         ->join('users', 'user_register_logs.user_id', '=', 'users.id')
    //         ->join('candidates', 'users.id', '=', 'candidates.user_id')
    //         ->select(
    //             'user_register_logs.id as record_id',
    //             'candidates.id as id',
    //             'money as money',
    //             'enroll_date as date',
    //             'creator_id',
    //             'user_register_logs.updated_at as updated_at',
    //             \DB::raw("'1' as type"),
    //             \DB::raw("'0' as type")
    //         );

    //     $combinedQuery = $employer->union($candidate)->union($register);

    //     $combinedResults = VacancyDeposit::fromSub($combinedQuery, 'combined_query')
    //         ->get();


    //     $mustBeEnrolled['items'] = $combinedResults;
    //     $mustBeEnrolled['role_id'] = Auth::user()->role_id;

    //     return ['enrolled' => $enrolled, 'mustBeEnrolled' => $mustBeEnrolled];
    // }
}

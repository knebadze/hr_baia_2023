<?php

namespace App\Repositories\Enrollment;

use Carbon\Carbon;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentPageRepository
{
    function hrData()  {
        $currentMonth = Carbon::now()->format('m');
        $enrolled = [];
        $enrolled['items'] = Enrollment::whereMonth('enrollments.created_at', $currentMonth)
            ->where('enrollments.author_id', Auth::id())
            ->orderBy('agree', 'ASC')
            ->join('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
            ->join('users', 'enrollments.author_id', '=', 'users.id')
            ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
            ->paginate(25);

        $enrolled['info'] = Enrollment::whereMonth('created_at', $currentMonth)
            ->where('author_id', Auth::id())
            ->selectRaw(
                "SUM(CASE WHEN agree = 0 THEN 1 ELSE 0 END) AS agree_no_count,
                SUM(CASE WHEN agree = 1 THEN 1 ELSE 0 END) AS agree_count,
                SUM(CASE WHEN agree = 1 THEN money ELSE 0 END) AS total_money,
                SUM(CASE WHEN agree = 1 THEN hr_bonus ELSE 0 END) AS total_hr_bonus"
            )
        ->first();

        $enrolled['role_id'] = Auth::user()->role_id;
        return ['enrolled' => $enrolled];
    }
    function adminData()  {
        $currentMonth = Carbon::now()->format('m');
        $enrolled = [];
        $enrolled['items'] = Enrollment::whereMonth('enrollments.created_at', $currentMonth)
            ->orderBy('agree', 'ASC')
            ->join('vacancies', 'enrollments.vacancy_id', '=', 'vacancies.id')
            ->join('users', 'enrollments.author_id', '=', 'users.id')
            ->select('enrollments.*', 'vacancies.code', 'users.name_ka')
            ->paginate(25);

        $enrolled['info'] = Enrollment::whereMonth('created_at', $currentMonth)
            ->selectRaw(
                "SUM(CASE WHEN agree = 0 THEN 1 ELSE 0 END) AS agree_no_count,
                SUM(CASE WHEN agree = 1 THEN 1 ELSE 0 END) AS agree_count,
                SUM(CASE WHEN agree = 1 THEN money ELSE 0 END) AS total_money,
                SUM(CASE WHEN agree = 1 THEN hr_bonus ELSE 0 END) AS total_hr_bonus"
            )
        ->first();

        $enrolled['role_id'] = Auth::user()->role_id;
        return ['enrolled' => $enrolled];
    }
}

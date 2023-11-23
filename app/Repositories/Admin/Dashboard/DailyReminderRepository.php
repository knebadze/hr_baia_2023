<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DailyReminderRepository
{
    function data() {
        return DB::table('vacancy_reminders as a')->orderBy('created_at', 'DESC')
            ->whereDate('a.date', Carbon::today())
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('a.hr_id', Auth::user()->hr->id);
            })
            ->join('vacancies as b', 'b.id', '=', 'a.vacancy_id')
            ->join('hrs as c', 'c.id', '=', 'a.hr_id')
            ->join('users as d', 'c.user_id', '=', 'd.id')
            ->select('a.*',  'b.code as code', 'd.name_ka as hr_name')
            ->get();
    }
}

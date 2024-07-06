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
            ->when(Auth::guard('staff')->user()->role_id !== 1, function ($query) {
                return $query->where('a.hr_id', Auth::guard('staff')->user()->id);
            })
            ->join('vacancies as b', 'b.id', '=', 'a.vacancy_id')
            ->join('staff as c', 'c.id', '=', 'a.hr_id')
            ->select('a.*',  'b.code as code', 'c.name_ka as hr_name')
            ->get();
    }
}

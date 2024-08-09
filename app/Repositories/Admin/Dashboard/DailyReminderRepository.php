<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DailyReminderRepository
{
    function data() {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $isAdmin = $auth->role_id === 1;

        return DB::table('vacancy_reminders as a')
            ->orderBy('created_at', 'DESC')
            ->whereDate('a.date', Carbon::today())
            ->when(!$isAdmin, function ($query) use ($authId) {
                return $query->where('a.hr_id', $authId);
            })
            ->join('vacancies as b', 'b.id', '=', 'a.vacancy_id')
            ->join('staff as c', 'c.id', '=', 'a.hr_id')
            ->when($isAdmin, function ($query) use ($authId) {
                return $query->where('c.parent_id', $authId);
            })
            ->select('a.*', 'b.code as code', 'c.name_ka as hr_name')
            ->get();
    }
}

<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\Auth;

class DailyReminderRepository
{
    function admin()  {
        return VacancyReminder::orderBy('created_at', 'DESC')->whereDate('date', Carbon::today())->with(['vacancy', 'hr.user'])->get();
    }
    function hr() {
        return VacancyReminder::orderBy('created_at', 'DESC')->whereDate('date', Carbon::today())->where('hr_id', Auth::user()->hr->id)->with('vacancy')->get();
    }
}

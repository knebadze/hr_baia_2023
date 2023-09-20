<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\Auth;

class DailyReminderRepository
{
    function data() {
        return VacancyReminder::orderBy('created_at', 'DESC')
            ->whereDate('date', Carbon::today())
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->hr->id);
            })
            ->with(['vacancy', 'hr.user'])
            ->get();
    }
}

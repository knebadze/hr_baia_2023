<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\hrDailyWork;
use App\Models\HrHasVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HrDailyWorkRepository
{
    function data() {
        // Retrieve the last uploaded record
        $lastRecord = Vacancy::orderBy('created_at', 'desc')
                ->first();

        // Retrieve the next record after the last uploaded record
        $nextRecord = HrHasVacancy::where('is_active', 1)
            ->where('has_vacancy', 0)
            ->first();

        $dailyWork = hrDailyWork::from('hr_daily_works as a')
            ->whereDate('a.created_at', Carbon::today())
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->hr->id);
            })
            ->join('hrs as b', 'a.hr_id', '=', 'b.id')
            ->join('users as c', 'b.user_id', '=', 'c.id')
            ->select('a.*', 'c.name_ka')
            ->get()->toArray();
        return ['lastRecord' => $lastRecord->hr->user->name_ka, 'nextRecord' => $nextRecord->hr->user->name_ka, 'dailyWork' => $dailyWork];
    }
}

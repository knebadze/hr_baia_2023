<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Vacancy;
use App\Models\hrDailyWork;
use App\Models\HrHasVacancy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HrDailyWorkRepository
{
    function hrData() {
        // Retrieve the last uploaded record
        $lastRecord = Vacancy::orderBy('created_at', 'desc')
                ->first();

        // Retrieve the next record after the last uploaded record
        $nextRecord = null;
        $find = HrHasVacancy::where('is_active', 1)
            ->where('re_write', '<', 0)
            ->orderBy('re_write', 'ASC')
            ->first();
        if ($find) {
            $nextRecord = $find;
        }else{
            $nextRecord = HrHasVacancy::where('is_active', 1)
            ->where('has_vacancy', 0)
            ->first();
        }

        $noActive = HrHasVacancy::where('is_active', 0)
            // ->where('has_vacancy', 0)
            ->with('hr.user')
            ->get()
            ->toArray();

        $dailyWork = hrDailyWork::from('hr_daily_works as a')
            ->whereDate('a.created_at', Carbon::today())
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->hr->id);
            })
            ->join('hrs as b', 'a.hr_id', '=', 'b.id')
            ->join('users as c', 'b.user_id', '=', 'c.id')
            ->where('c.role_id', 2)
            ->select('a.*', 'c.name_ka')
            ->get()->toArray();
        return ['lastRecord' => $lastRecord ? $lastRecord->hr->user->name_ka : '', 'nextRecord' => $nextRecord? $nextRecord->hr->user->name_ka: '', 'dailyWork' => $dailyWork, 'noActive' => $noActive];
    }

    function administratorDate()  {
        $dailyWork = hrDailyWork::from('hr_daily_works as a')
            ->whereDate('a.created_at', Carbon::today())
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('hr_id', Auth::user()->staff->id);
            })
            ->join('hrs as b', 'a.hr_id', '=', 'b.id')
            ->join('users as c', 'b.user_id', '=', 'c.id')
            ->where('c.role_id', 4)
            ->select('a.*', 'c.name_ka')
            ->get();
        $noActive = User::where('role_id', 4)
            ->where('is_active', 0)
            ->with('staff')
            ->get()
            ->toArray();
        // $lastRecord =
        return ['dailyWork' => $dailyWork, 'noActive' => $noActive];
    }
}

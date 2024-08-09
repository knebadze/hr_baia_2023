<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Vacancy;
use App\Models\HrHasVacancy;
use App\Models\StaffDailyWork;
use Illuminate\Support\Facades\Auth;


class StaffDailyWorkRepository
{
    function hrData() {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $isAdmin = $auth->role_id === 1;

        // Retrieve the last uploaded record
        $lastRecord = Vacancy::orderBy('created_at', 'desc')->first();

        // Retrieve the next record after the last uploaded record
        $nextRecord = HrHasVacancy::where('is_active', 1)
            ->where('re_write', '<', 0)
            ->orderBy('re_write', 'ASC')
            ->first() ?? HrHasVacancy::where('is_active', 1)
            ->where('has_vacancy', 0)
            ->first();

        $noActive = HrHasVacancy::where('is_active', 0)
            ->with('hr')
            ->get()
            ->toArray();

        $dailyWork = StaffDailyWork::from('staff_daily_works as a')
            ->whereDate('a.created_at', Carbon::today())
            ->when(!$isAdmin, function ($query) use ($authId) {
                return $query->where('staff_id', $authId);
            })
            ->join('staff as b', 'a.staff_id', '=', 'b.id')
            ->where('b.role_id', 2)
            ->when($isAdmin, function ($query) use ($authId) {
                return $query->where('b.parent_id', $authId);
            })
            ->select('a.*', 'b.name_ka')
            ->get()
            ->toArray();

        return [
            'lastRecord' => $lastRecord ? $lastRecord->hr->name_ka : '',
            'nextRecord' => $nextRecord ? $nextRecord->name_ka : '',
            'dailyWork' => $dailyWork,
            'noActive' => $noActive
        ];
    }

    function administratorDate() {
        $auth = Auth::guard('staff')->user();
        $authId = $auth->id;
        $isAdmin = $auth->role_id === 1;

        $dailyWork = StaffDailyWork::from('staff_daily_works as a')
            ->whereDate('a.created_at', Carbon::today())
            ->when(!$isAdmin, function ($query) use ($authId) {
                return $query->where('staff_id', $authId);
            })
            ->join('staff as b', 'a.staff_id', '=', 'b.id')
            ->where('b.role_id', 4)
            ->when($isAdmin, function ($query) use ($authId) {
                return $query->where('b.parent_id', $authId);
            })
            ->select('a.*', 'b.name_ka')
            ->get();

        $noActive = Staff::where('role_id', 4)
            ->where('parent_id', $authId)
            ->where('is_active', 0)
            ->get()
            ->toArray();

        return ['dailyWork' => $dailyWork, 'noActive' => $noActive];
    }
}

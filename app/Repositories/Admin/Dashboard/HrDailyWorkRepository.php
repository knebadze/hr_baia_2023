<?php

namespace App\Repositories\Admin\Dashboard;

use App\Models\HrHasVacancy;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HrDailyWorkRepository
{
    function data() {
        // Retrieve the last uploaded record
        $lastRecord = HrHasVacancy::orderBy('updated_at', 'desc')
                ->first();

        // Retrieve the next record after the last uploaded record
        $nextRecord = HrHasVacancy::where('is_active', 1)
            ->where('has_vacancy', 0)
            ->with('hr.user')
            ->first();
        $user = DB::table('users')->from('users as a')->where('role_id', 2)
                ->where('is_active', 1)
                ->join('hrs as b', 'a.id', 'b.user_id')
                ->leftJoin('vacancies as c', 'b.id', 'c.hr_id')
                ->whereDate('c.created_at', Carbon::today())

                ->get()->toArray();


                dd($lastRecord->hr->user->name_ka, $nextRecord, $user);
        return [];
    }
}

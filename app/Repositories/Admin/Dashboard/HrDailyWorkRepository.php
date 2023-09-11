<?php

namespace App\Repositories\Admin\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class HrDailyWorkRepository
{
    function data() {
        $user = DB::table('users')->from('users as a')->where('role_id', 3)
                ->where('is_active', 1)
                ->join('hrs as b', 'a.id', 'b.user_id')
                ->leftJoin('vacancies as c', 'b.id', 'c.hr_id')
                ->whereDate('c.created_at', Carbon::today())
                
                ->get();
                dd($user);
    }
}

<?php

namespace App\Repositories\Admin;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReminderDataRepository
{
    function addReminder($data, $hr_id)  {
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $data['vacancy_id'];

        $reminder->hr_id = $hr_id;
        $reminder->date = $data['date'];
        $reminder->reason = $data['reason'];
        $reminder->main = $data['main'];
        if (array_key_exists('active', $data)) {
            VacancyReminder::where('id', $data['id'])->update(['active' => $data['active']]);
        }
        $reminder->save();
    }
    function admin()  {
        $data = [];
        $now = Carbon::now();
        $data = DB::table('vacancy_reminders as a')
            ->orderBy('a.created_at', 'DESC')
            ->whereDate('a.date', '>=', $now->startOfWeek())
            ->whereDate('a.date', '<=', $now->endOfWeek())
            ->join('vacancies as b', 'b.id', '=', 'a.vacancy_id')
            ->join('staff as c', 'c.id', '=', 'a.hr_id')
            ->select('a.*',  'b.code as code', 'c.name_ka as hr_name')
            ->get();
        return $data;
    }

    function hr()  {
        $data = [];
        $now = Carbon::now();


        $data = DB::table('vacancy_reminders as a')
            ->orderBy('a.created_at', 'DESC')
            ->whereDate('a.date', '>=', $now->startOfWeek())
            ->whereDate('a.date', '<=', $now->endOfWeek())
            ->where('a.hr_id', Auth::guard('staff')->user()->id)
            ->join('vacancies as b', 'b.id', '=', 'a.vacancy_id')
            ->select('a.*',  'b.code as code')
            ->get();
        return $data;
    }
}

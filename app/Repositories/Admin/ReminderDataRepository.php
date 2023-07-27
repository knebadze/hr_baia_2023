<?php

namespace App\Repositories\admin;

use Carbon\Carbon;
use App\Models\VacancyReminder;
use Illuminate\Support\Facades\Auth;

class ReminderDataRepository
{
    function addReminder($data, $hr_id)  {
        $reminder = new VacancyReminder();
        $reminder->vacancy_id = $data['vacancy_id'];
        
        $reminder->hr_id = $hr_id;
        $reminder->date = $data['date'];
        $reminder->reason = $data['reason'];
        if (array_key_exists('active', $data)) {
            VacancyReminder::where('id', $data['id'])->update(['active' => $data['active']]);
        }
        $reminder->save();
    }
    function admin()  {
        $data = [];
        $now = Carbon::now();
        // $now->startOfWeek(); Start of the current week (Sunday)
        // $now->endOfWeek(); End of the current week (Saturday)
        $data['daily'] = VacancyReminder::orderBy('created_at', 'DESC')
                        ->whereDate('date', Carbon::today())
                        ->with(['vacancy', 'hr.user'])
                        ->get();
        $data['current'] = VacancyReminder::orderBy('date', 'ASC')
                            ->where('active', 0)
                            ->where(function ($query) use ($now) {
                                $query->where('date', '>', $now)
                                    ->orWhere(function ($query) use ($now) {
                                        $query->whereDate('date', '=', $now)
                                              ->whereTime('date', '>', $now);
                                    });
                            })
                            ->with(['vacancy', 'hr.user'])
                            ->get();
        $data['weekly'] = VacancyReminder::orderBy('created_at', 'DESC')
                            ->whereDate('date', '>=', $now->startOfWeek())
                            ->whereDate('date', '<=', $now->endOfWeek())
                            ->with(['vacancy', 'hr.user'])
                            ->get();
        return $data;
    }

    function hr()  {
        $data = [];
        $now = Carbon::now();
        // $now->startOfWeek(); Start of the current week (Sunday)
        // $now->endOfWeek(); End of the current week (Saturday)
        $data['daily'] = VacancyReminder::orderBy('created_at', 'DESC')
                        ->whereDate('date', Carbon::today())
                        ->where('hr_id', Auth::user()->hr->id)
                        ->with('vacancy')
                        ->get();
        $data['current'] = VacancyReminder::orderBy('date', 'ASC')
                            ->where('active', 0)
                            ->where(function ($query) use ($now) {
                                $query->where('date', '>', $now)
                                    ->orWhere(function ($query) use ($now) {
                                        $query->whereDate('date', '=', $now)
                                              ->whereTime('date', '>', $now);
                                    });
                            })
                            ->where('hr_id', Auth::user()->hr->id)
                            ->with('vacancy')
                            ->get();
        $data['weekly'] = VacancyReminder::orderBy('created_at', 'DESC')
                            ->whereDate('date', '>=', $now->startOfWeek())
                            ->whereDate('date', '<=', $now->endOfWeek())
                            ->where('hr_id', Auth::user()->hr->id)
                            ->with('vacancy')
                            ->get();
        return $data;
    }
}

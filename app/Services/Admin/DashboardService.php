<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\Dashboard\HrDailyWorkRepository;
use App\Repositories\Admin\Dashboard\DailyReminderRepository;

class DashboardService
{
    protected DailyReminderRepository $dailyReminderRepository;
    protected HrDailyWorkRepository $hrDailyWorkRepository;
    public function __construct()
    {
        $this->dailyReminderRepository = new DailyReminderRepository;
        $this->hrDailyWorkRepository = new HrDailyWorkRepository;
    }

    function dailyReminder() {
        if (Auth::user()->role_id == 1) {
            $result = $this->dailyReminderRepository->admin();
        }else{
            $result = $this->dailyReminderRepository->hr();
        }

        return $result;
    }

    function hrDailyWork() {
        $result = $this->hrDailyWorkRepository->data();

        return $result;
    }
}

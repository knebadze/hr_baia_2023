<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\Dashboard\StaffDailyWorkRepository;
use App\Repositories\Admin\Dashboard\DailyReminderRepository;
use App\Repositories\Admin\Dashboard\InfoBoxRepository;

class DashboardService
{
    protected InfoBoxRepository $infoBoxRepository;
    protected DailyReminderRepository $dailyReminderRepository;
    protected StaffDailyWorkRepository $StaffDailyWorkRepository;
    public function __construct()
    {
        $this->infoBoxRepository = new InfoBoxRepository;
        $this->dailyReminderRepository = new DailyReminderRepository;
        $this->StaffDailyWorkRepository = new StaffDailyWorkRepository;
    }

    function getData(){
        $role_id = Auth::guard('staff')->user()->role_id;
        $infoBox = $this->infoBoxRepository->data();
        $dailyReminder = $this->dailyReminderRepository->data();
        $staffDailyWork = null;
        if ($role_id == 1) {
            $staffDailyWork = ['hr' => $this->StaffDailyWorkRepository->hrData(), 'administrator' => $this->StaffDailyWorkRepository->administratorDate()];
        }else if ($role_id == 2) {
            $staffDailyWork = $this->StaffDailyWorkRepository->hrData();
        }else{
            $staffDailyWork = $this->StaffDailyWorkRepository->administratorDate();
        }
        return ['infoBox' => $infoBox, 'dailyReminder' => $dailyReminder, 'staffDailyWork' => $staffDailyWork];
    }
}

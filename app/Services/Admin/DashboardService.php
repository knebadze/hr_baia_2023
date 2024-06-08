<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\Dashboard\HrDailyWorkRepository;
use App\Repositories\Admin\Dashboard\DailyReminderRepository;
use App\Repositories\Admin\Dashboard\InfoBoxRepository;

class DashboardService
{
    protected InfoBoxRepository $infoBoxRepository;
    protected DailyReminderRepository $dailyReminderRepository;
    protected HrDailyWorkRepository $hrDailyWorkRepository;
    public function __construct()
    {
        $this->infoBoxRepository = new InfoBoxRepository;
        $this->dailyReminderRepository = new DailyReminderRepository;
        $this->hrDailyWorkRepository = new HrDailyWorkRepository;
    }

    function getData(){
        $role_id = Auth::user()->role_id;
        $infoBox = $this->infoBoxRepository->data();
        $dailyReminder = $this->dailyReminderRepository->data();
        $hrDailyWork = null;
        if ($role_id == 1) {
            $hrDailyWork = ['hr' => $this->hrDailyWorkRepository->hrData(), 'administrator' => $this->hrDailyWorkRepository->administratorDate()];
        }else if ($role_id == 2) {
            $hrDailyWork = $this->hrDailyWorkRepository->hrData();
        }else{
            $hrDailyWork = $this->hrDailyWorkRepository->administratorDate();
        }
        return ['infoBox' => $infoBox, 'dailyReminder' => $dailyReminder, 'hrDailyWork' => $hrDailyWork];
    }
}

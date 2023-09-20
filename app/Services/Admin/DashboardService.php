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
        $infoBox = $this->infoBoxRepository->data();
        $dailyReminder = $this->dailyReminderRepository->data();
        $hrDailyWork = $this->hrDailyWorkRepository->data();
        return ['infoBox' => $infoBox, 'dailyReminder' => $dailyReminder, 'hrDailyWork' => $hrDailyWork];
    }
}

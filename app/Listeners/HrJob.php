<?php

namespace App\Listeners;

use App\Events\hrDailyJob;
use App\Models\hrDailyWork;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HrJob
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\hrDailyJob  $event
     * @return void
     */
    public function handle(hrDailyJob $event)
    {
        $record = hrDailyWork::where('hr_id', $event->hr_id)->whereDate('created_at', Carbon::today())->first();
        if (!$record) {
            $record = new hrDailyWork();
            $record->hr_id = $event->hr_id;
            $record->save();
        }
        $record->increment($event->filed);
    }
}

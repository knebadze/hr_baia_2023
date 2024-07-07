<?php

namespace App\Listeners;

use App\Events\staffDailyJob;
use App\Models\StaffDailyWork;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class staffJob
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
     * @param  \App\Events\staffDailyJob  $event
     * @return void
     */
    public function handle(staffDailyJob $event)
    {
        $record = StaffDailyWork::where('staff_id', $event->staff_id)->whereDate('created_at', Carbon::today())->first();
        if (!$record) {
            $record = new StaffDailyWork();
            $record->staff_id = $event->staff_id;
            $record->save();
        }
        $record->increment($event->filed);
    }
}

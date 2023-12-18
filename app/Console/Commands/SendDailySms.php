<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailySms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:send-daily-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send daily sms';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        app(\App\Services\SendDailySmsService::class)->check();
        return Command::SUCCESS;
    }
}

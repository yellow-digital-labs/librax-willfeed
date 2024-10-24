<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SubscriptionPayment;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:subscription-payment')
            ->dailyAt("01:05")
            ->runInBackground()
            ->emailOutputTo("yellow.digital.labs+cron@gmail.com")
            ->emailOutputOnFailure("yellow.digital.labs+failure@gmail.com");

        $schedule->command('app:send-payment-reminder-email')
            ->dailyAt("08:05")
            ->runInBackground()
            ->emailOutputTo("yellow.digital.labs+cron@gmail.com")
            ->emailOutputOnFailure("yellow.digital.labs+failure@gmail.com");
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

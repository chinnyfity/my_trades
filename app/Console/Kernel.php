<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected $commands = [
        Commands\WeeklyUpdates::class,
    ];

    
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:users')->daily(); // monday 1am
        //$schedule->command('update:users')->everyMinute(); // monday 1am
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

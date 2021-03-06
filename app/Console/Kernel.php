<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\WeeklyReportCommand',
        'App\Console\Commands\BeforeDueDateCommand',
        'App\Console\Commands\AfterDueDateCommand',
        'App\Console\Commands\DisableUsersCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('weekly:report')
        ->weekly()->saturdays()->at('23:59');
        $schedule->command('daily:prereminder')
        ->daily()->at('07:00');
        $schedule->command('daily:postreminder')
        ->daily()->at('07:00');
        $schedule->command('disable:user')
        ->daily()->at('07:00');
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

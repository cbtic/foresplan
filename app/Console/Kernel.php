<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel.
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\actualizaAsistenciaAutomaticoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('actualizaAsistenciaAutomatico:cron')->dailyAt('08:00');
		$schedule->command('actualizaAsistenciaAutomatico:cron')->dailyAt('09:00');
		$schedule->command('actualizaAsistenciaAutomatico:cron')->dailyAt('16:00');
		$schedule->command('actualizaAsistenciaAutomatico:cron')->dailyAt('18:00');
		$schedule->command('actualizaAsistenciaAutomatico:cron')->dailyAt('23:50');
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

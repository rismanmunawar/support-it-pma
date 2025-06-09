<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\PengumumanCleanup::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pengumuman:cleanup')
            ->twiceMonthly(1, 15)
            ->at('02:00');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

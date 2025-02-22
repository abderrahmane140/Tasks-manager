<?php

namespace App\Console;

use Illuminate\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Add your console commands here
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule tasks
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

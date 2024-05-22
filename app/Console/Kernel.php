<?php

// app/Console/Kernel.php

namespace App\Console;

use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('app:delete-old-opportunities')->everySecond();

        $schedule->call(function () {
            $threshold = Carbon::now()->subSeconds(30);

            $opportunities = Opportunity::where('published_at', '<', $threshold)->get();

            foreach ($opportunities as $opportunity) {
                $opportunity->delete();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands/DeleteOldOpp.php');

        require base_path('routes/console.php');
    }
}

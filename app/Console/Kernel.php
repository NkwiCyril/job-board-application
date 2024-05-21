<?php

// app/Console/Kernel.php
namespace App\Console;

use Carbon\Carbon;
use App\Models\Opportunity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('app:delete-old-opportunities')->everySecond();

        $schedule->call(function() {
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
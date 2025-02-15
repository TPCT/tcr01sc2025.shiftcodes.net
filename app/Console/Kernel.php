<?php

namespace App\Console;

use App\Models\Company;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {
            Company::all()->each(function(Company $company ) {
                $company->update([
                        "refresh_limit" => 100 + $company->getRefreshCarsCount()
                    ]);
            });
        })->name('refresh:companies')
            ->dailyAt("05:00")
            ->timezone("Asia/Dubai")
            ->withoutOverlapping();
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

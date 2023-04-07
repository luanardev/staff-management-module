<?php

namespace Lumis\StaffManagement\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {

            $schedule->command('contract:reminder')->monthly();
            $schedule->command('retirement:reminder')->monthly();
            $schedule->command('probation:reminder')->monthly();
            $schedule->command('employee:retire')->daily();
            $schedule->command('contract:terminate')->daily();
            $schedule->command('appointment:terminate')->daily();
        });
    }

}

<?php

namespace Lumis\StaffManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Lumis\StaffManagement\Console\DismissAppointment;
use Lumis\StaffManagement\Console\ProcessRetirement;
use Lumis\StaffManagement\Console\RemindProbation;
use Lumis\StaffManagement\Console\RemindRetirement;
use Lumis\StaffManagement\Console\RemindTermination;
use Lumis\StaffManagement\Console\ConfirmEmployment;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                RemindTermination::class,
                RemindRetirement::class,
                RemindProbation::class,
                ProcessRetirement::class,
                ConfirmEmployment::class,
                DismissAppointment::class,
                ConfirmEmployment::class
            ]);
        }

    }
}

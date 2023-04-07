<?php

namespace Lumis\StaffManagement\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Notifications\Admin\ProbationNotification;
use Lumis\StaffManagement\Facades\StaffConfig;

class ProbationReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $probation = Employment::getProbation();

        if ($probation->count() > 0) {
            $adminEmail = StaffConfig::get('admin_email');
            Notification::route('mail', $adminEmail)->notify(
                new ProbationNotification()
            );
        }


    }


}

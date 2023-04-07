<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\EmploymentCreated;
use Lumis\StaffManagement\Notifications\EmploymentNotification;
use StaffConfig;

class SendEmploymentNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param EmploymentCreated $event
     * @return void
     */
    public function handle(EmploymentCreated $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            $employment = $event->employment;
            Notification::route('mail', $employment->staff->personal_email)->notify(
                new EmploymentNotification($employment)
            );
        }

    }
}

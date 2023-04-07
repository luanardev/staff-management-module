<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\ProfileCreated;
use Lumis\StaffManagement\Notifications\WelcomeNotification;
use StaffConfig;

class SendWelcomeNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param ProfileCreated $event
     * @return void
     */
    public function handle(ProfileCreated $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            Notification::route('mail', $event->staff->personal_email)->notify(
                new WelcomeNotification($event->staff)
            );
        }
    }
}

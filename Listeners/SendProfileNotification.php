<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\ProfileUpdated;
use Lumis\StaffManagement\Notifications\ProfileUpdateNotification;
use StaffConfig;

class SendProfileNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param ProfileUpdated $event
     * @return void
     */
    public function handle(ProfileUpdated $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            Notification::send(
                $event->staff,
                new ProfileUpdateNotification($event->staff)
            );
        }
    }
}

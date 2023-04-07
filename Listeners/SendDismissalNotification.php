<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\Dismissal;
use Lumis\StaffManagement\Notifications\DismissalNotification;
use StaffConfig;

class SendDismissalNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Dismissal $event
     * @return void
     */
    public function handle(Dismissal $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            Notification::send(
                $event->staff,
                new DismissalNotification($event->staff)
            );
        }
    }
}

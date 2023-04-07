<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\Confirmation;
use Lumis\StaffManagement\Notifications\ConfirmationNotification;
use StaffConfig;

class SendConfirmationNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Confirmation $event
     * @return void
     */
    public function handle(Confirmation $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {

            Notification::send(
                $event->staff,
                new ConfirmationNotification($event->staff)
            );
        }
    }
}

<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\AccountCreated;
use Lumis\StaffManagement\Notifications\UserAccountNotification;
use StaffConfig;

class SendUserAccountNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param AccountCreated $event
     * @return void
     */
    public function handle(AccountCreated $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            Notification::route('mail', $event->staff->personal_email)->notify(
                new UserAccountNotification($event->staff, $event->password)
            );
        }
    }
}

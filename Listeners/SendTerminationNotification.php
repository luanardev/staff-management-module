<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\Termination;
use Lumis\StaffManagement\Notifications\Admin\TerminationNotification as AdminNotification;
use Lumis\StaffManagement\Notifications\TerminationNotification;
use StaffConfig;

class SendTerminationNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Termination $event
     * @return void
     */
    public function handle(Termination $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        $adminEmail = StaffConfig::get('admin_email');

        if ($shouldNotify) {
            Notification::send(
                $event->staff,
                new TerminationNotification($event->staff)
            );

            Notification::route('mail', $adminEmail)->notify(
                new AdminNotification($event->staff)
            );
        }
    }
}

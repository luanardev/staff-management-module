<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\Retirement;
use Lumis\StaffManagement\Notifications\Admin\RetirementNotification as AdminNotification;
use Lumis\StaffManagement\Notifications\RetirementNotification;
use StaffConfig;

class SendRetirementNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Retirement $event
     * @return void
     */
    public function handle(Retirement $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');
        $adminEmail = StaffConfig::get('admin_email');

        if ($shouldNotify) {
            Notification::send(
                $event->staff,
                new RetirementNotification($event->staff)
            );

            Notification::route('mail', $adminEmail)->notify(
                new AdminNotification($event->staff)
            );
        }
    }
}

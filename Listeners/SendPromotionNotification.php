<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Lumis\StaffManagement\Events\Promotion;
use Lumis\StaffManagement\Notifications\PromotionNotification;
use StaffConfig;

class SendPromotionNotification implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param Promotion $event
     * @return void
     */
    public function handle(Promotion $event): void
    {
        $shouldNotify = (bool)StaffConfig::get('send_notification');

        if ($shouldNotify) {
            Notification::send(
                $event->progress->staff,
                new PromotionNotification($event->progress)
            );
        }
    }
}

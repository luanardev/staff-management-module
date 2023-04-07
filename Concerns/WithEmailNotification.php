<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Notifications\Notification;

trait WithEmailNotification
{
    /**
     * Route notifications for the mail channel.
     *
     * @param Notification $notification
     * @return array|string
     */
    public function routeNotificationForMail(Notification $notification): array|string
    {
        if ($this->wasRecentlyCreated === true) {
            return $this->personal_email;
        } else {
            return $this->official_email;
        }
    }
}

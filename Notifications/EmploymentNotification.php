<?php

namespace Lumis\StaffManagement\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lumis\StaffManagement\Entities\Employment;

class EmploymentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Employment
     */
    public Employment $employment;

    /**
     * Create a new notification instance.
     * @param Employment $employment
     * @return void
     */
    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->markdown('staffmanagement::emails.employment', [
                'employment' => $this->employment
            ]);
    }


}

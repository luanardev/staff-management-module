<?php

namespace Lumis\StaffManagement\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lumis\StaffManagement\Entities\Employment;

class ProbationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var array
     */
    public $probationList;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct()
    {
        $this->probationList = Employment::getProbation();
    }

    /**
     * Interrupt notification when the condition is true
     *
     * @param mixed $notifiable
     * @return bool
     */
    public function shouldInterrupt(mixed $notifiable): bool
    {
        return $this->staff->isNotActive();
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
        return (new MailMessage)->markdown('staffmanagement::emails.admin.probation', [
            'probationList' => $this->probationList
        ]);
    }

}

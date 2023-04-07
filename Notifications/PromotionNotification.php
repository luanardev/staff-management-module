<?php

namespace Lumis\StaffManagement\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lumis\StaffManagement\Entities\Progress;

class PromotionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *
     * @var Progress
     */
    public Progress $progress;

    /**
     * Create a new event instance.
     * @param Progress $progress
     * @return void
     */
    public function __construct(Progress $progress)
    {
        $this->progress = $progress;
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
            ->markdown('staffmanagement::emails.promotion', [
                'progress' => $this->progress
            ]);
    }


}

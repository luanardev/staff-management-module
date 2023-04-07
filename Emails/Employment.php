<?php

namespace Lumis\StaffManagement\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Staff;

class Employment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new message instance.
     * @param Staff $staff
     * @return void
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('staffmanagement::emails.employment');
    }
}

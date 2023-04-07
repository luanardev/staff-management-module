<?php

namespace Lumis\StaffManagement\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Staff;

class UserAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * @var string
     */
    public string $password;

    /**
     * Create a new event instance.
     * @param Staff $staff
     * @param string $password
     * @return void
     */
    public function __construct(Staff $staff, string $password)
    {
        $this->staff = $staff;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('staffmanagement::emails.userprofile');
    }
}

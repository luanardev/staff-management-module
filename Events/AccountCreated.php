<?php

namespace Lumis\StaffManagement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Staff;

class AccountCreated
{
    use Dispatchable, SerializesModels;

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

}

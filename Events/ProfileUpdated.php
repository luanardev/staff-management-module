<?php

namespace Lumis\StaffManagement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Staff;

class ProfileUpdated
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new event instance.
     * @param Staff $staff
     * @return void
     */
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

}

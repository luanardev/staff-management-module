<?php

namespace Lumis\StaffManagement\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\Staff;

class EmploymentCreated
{
    use Dispatchable, SerializesModels;

    /**
     *
     * @var Employment
     */
    public Employment $employment;

    /**
     *
     * @var Staff
     */
    public Staff $staff;

    /**
     * Create a new event instance.
     * @param Employment $employment
     * @return void
     */
    public function __construct(Employment $employment)
    {
        $this->employment = $employment;
        $this->staff = $employment->staff;
    }

}

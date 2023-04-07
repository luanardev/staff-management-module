<?php

namespace Lumis\StaffManagement\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Lumis\StaffManagement\Events\EmploymentCreated;
use StaffConfig;


class CreateUserAccount implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param EmploymentCreated $event
     * @return void
     */
    public function handle(EmploymentCreated $event): void
    {
        $shouldCreate = (bool)StaffConfig::get('create_staff_account');

        if ($shouldCreate) {
            $event->staff->createAccount();
        }

    }


}

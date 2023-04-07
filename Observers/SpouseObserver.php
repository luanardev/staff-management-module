<?php

namespace Lumis\StaffManagement\Observers;

use Lumis\StaffManagement\Entities\Spouse;

class SpouseObserver
{
    /**
     * Handle the Spouse "created" event.
     *
     * @param Spouse $spouse
     * @return void
     */
    public function created(Spouse $spouse): void
    {
        $spouse->staff->update(['marital_status' => 'Married']);
    }

    /**
     * Handle the Spouse "deleted" event.
     *
     * @param Spouse $spouse
     * @return void
     */
    public function deleted(Spouse $spouse): void
    {
        $spouse->staff->update(['marital_status' => 'Single']);
    }

}

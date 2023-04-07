<?php

namespace Lumis\StaffManagement\Observers;

use Exception;
use Lumis\StaffManagement\Entities\Qualification;
use Storage;

class QualificationObserver
{

    /**
     * Handle the "updated" event.
     *
     * @param Qualification $qualification
     * @return void
     */
    public function updated(Qualification $qualification): void
    {
        if ($qualification->wasChanged('attachment')) {
            $this->removeAttachment($qualification);
        }
    }

    /**
     * Remove file
     *
     * @param Qualification $qualification
     * @return void
     */
    protected function removeAttachment(Qualification $qualification): void
    {
        try {
            $path = $qualification->getOriginal('attachment');
            if (!empty($path) && file_exists(storage_path('app/public/' . $path))) {
                unlink(storage_path('app/public/' . $path));
            }

        } catch (Exception $ex) {
        }
    }

    /**
     * Handle the Qualification "deleted" event.
     *
     * @param Qualification $qualification
     * @return void
     */
    public function deleted(Qualification $qualification): void
    {
        try {
            $path = $qualification->attachment;
            if (!empty($path) && file_exists(storage_path('app/public/' . $path))) {
                unlink(storage_path('app/public/' . $path));
            }

        } catch (Exception $ex) {
        }
    }


}

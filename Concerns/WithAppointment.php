<?php

namespace Lumis\StaffManagement\Concerns;

use Lumis\StaffManagement\Events\Dismissal;

trait WithAppointment
{

    /**
     * Dismiss appointment
     *
     * @return void
     */
    public function dismissAppointment(): void
    {
        $appointment = $this->getAppointment();
        $appointment->deactivate();

        $previous = $this->getPreviousProgress();
        $previous->activate();

        $this->setPosition(
            $previous->position_id,
            $previous->job_rank_id,
            $previous->job_type_id,
            $previous->job_status_id,
            $previous->progress_type_id,
            $previous->grade,
            $previous->notch,
            $previous->start_date,
            $previous->end_date
        );

        $this->saveQuietly();

        Dismissal::dispatch($this->staff);
    }

}

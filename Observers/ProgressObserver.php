<?php

namespace Lumis\StaffManagement\Observers;

use Exception;
use Lumis\StaffManagement\Entities\Deanship;
use Lumis\StaffManagement\Entities\Headship;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\ProgressType;
use Lumis\StaffManagement\Entities\Staff;


class ProgressObserver
{

    /**
     * Handle the Progress "creating" event.
     *
     * @param Progress $progress
     * @return void
     */
    public function creating(Progress $progress): void
    {
        $staff = $progress->staff;
        $previous = $this->getPreviousProgress($staff);
        if (!empty($previous)) {
            $previous->deactivate();
        }

    }

    /**
     * Get previous employment record
     *
     * @param Staff $staff
     * @return null|Progress
     */
    protected function getPreviousProgress(Staff $staff): null|Progress
    {
        $type = ProgressType::Appointment();
        return $staff->progress()
            ->where('progress_type_id', '<>', $type)
            ->latest()
            ->first();
    }

    /**
     * Handle the Progress "created" event.
     *
     * @param Progress $progress
     * @return void
     */
    public function created(Progress $progress): void
    {

        $employment = $progress->staff->employment;

        $employment->setServing()
            ->setTenurePeriod(
                $progress->start_date,
                $progress->end_date
            )
            ->updateJobPost(
                $progress->position_id,
                $progress->job_rank_id,
                $progress->job_type_id,
                $progress->job_status_id,
                $progress->progress_type_id,
                $progress->grade,
                $progress->notch,
                $progress->start_date,
                $progress->end_date
            );

    }

    /**
     * Handle the Progress "deleted" event.
     *
     * @param Progress $progress
     * @return void
     */
    public function deleted(Progress $progress): void
    {
        $staff = $progress->staff;

        if ($progress->isHeadship()) {
            $this->revertHeadship($progress);
        } elseif ($progress->isDeanship()) {
            $this->revertDeanship($progress);
        }

        $previous = $this->getPreviousProgress($staff);

        if (!empty($previous)) {
            $previous->activate();
            $this->revertPreviousPost($staff, $previous);
            $this->revertConfirmation($staff, $previous);
        }

    }

    /**
     *
     * @param Progress $progress
     * @return null
     */
    protected function revertHeadship(Progress $progress)
    {
        try {
            $record = Headship::getStaff($progress->staff);
            if (!empty($record)) {
                return $record->delete();
            }
        } catch (Exception $ex) {
        }

    }

    /**
     *
     * @param Progress $progress
     * @return null
     */
    protected function revertDeanship(Progress $progress)
    {
        try {
            $record = Deanship::getStaff($progress->staff);
            if (!empty($record)) {
                $record->delete();
            }
        } catch (Exception $ex) {
        }
    }

    /**
     *
     * @param Staff $staff
     * @param Progress $progress
     * @return void
     */
    protected function revertPreviousPost(Staff $staff, Progress $progress): void
    {
        $employment = $staff->employment;

        $employment->setTenurePeriod(
            $progress->start_date,
            $progress->end_date
        )
            ->updateJobPost(
                $progress->position_id,
                $progress->job_rank_id,
                $progress->job_type_id,
                $progress->job_status_id,
                $progress->progress_type_id,
                $progress->grade,
                $progress->notch,
                $progress->start_date,
                $progress->end_date
            );
        if ($progress->isPermanent()) {
            $employment->setConfirmed(true);
            $employment->saveQuietly();
        }

    }

    /**
     *
     * @param Staff $staff
     * @param Progress $progress
     * @return void
     */
    protected function revertConfirmation(Staff $staff, Progress $progress): void
    {
        $employment = $staff->employment;

        if ($progress->isContract()) {
            $employment->setConfirmed(false);
        } else {
            $employment->setConfirmed(true);
            $employment->setPermanent();
        }
        $employment->saveQuietly();

    }


}

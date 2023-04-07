<?php

namespace Lumis\StaffManagement\Observers;

use Illuminate\Support\Str;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\ProgressType;
use Lumis\StaffManagement\Events\EmploymentCreated;

class EmploymentObserver
{

    /**
     * Handle the Employment "updating" event.
     *
     * @param Employment $employment
     * @return void
     */
    public function creating(Employment $employment): void
    {
        if (empty($employment->branch_id)) {
            $branch = $employment->campus->branch;
            $employment->branch()->associate($branch);
        }

        $progressType = $this->progressType($employment);
        $employment->progressType()->associate($progressType);
    }

    /**
     * Get Progress Type
     *
     * @param Employment $employment
     * @return mixed
     */
    protected function progressType(Employment $employment): mixed
    {
        if ($employment->isPermanent()) {
            return ProgressType::Permanent();
        } else {
            return ProgressType::Contract();
        }
    }

    /**
     * Handle the Employment "created" event.
     *
     * @param Employment $employment
     * @return void
     */
    public function created(Employment $employment): void
    {
        $this->createProgress($employment);
        EmploymentCreated::dispatch($employment);

    }

    /**
     * Create progress record
     *
     * @param Employment $employment
     * @return void
     */
    protected function createProgress(Employment $employment): void
    {
        $progressType = $this->progressType($employment);

        $progress = new Progress();
        $progress->id = Str::uuid();
        $this->progressData($progress, $employment, $progressType);
    }

    /**
     * @param Progress $progress
     * @param Employment $employment
     * @param mixed $progressType
     * @return void
     */
    protected function progressData(Progress $progress, Employment $employment, mixed $progressType): void
    {
        $progress->progressType()->associate($progressType);
        $progress->staff()->associate($employment->staff_id);
        $progress->position()->associate($employment->position_id);
        $progress->jobRank()->associate($employment->job_rank_id);
        $progress->jobType()->associate($employment->job_type_id);
        $progress->jobStatus()->associate($employment->job_status_id);
        $progress->grade = $employment->grade;
        $progress->notch = $employment->notch;
        $progress->start_date = $employment->start_date;
        $progress->end_date = $employment->end_date;
        $progress->saveQuietly();
    }

    /**
     * Handle the Employment "updated" event.
     *
     * @param Employment $employment
     * @return void
     */
    public function updated(Employment $employment): void
    {
        if ($this->shouldUpdateProgress($employment)) {
            $this->updateProgress($employment);
        }
        if ($employment->wasChanged('job_type_id')) {
            $this->changeEmploymentType($employment);

        }
    }

    /**
     * Check whether position or grade or scale has changed
     *
     * @param Employment $employment
     * @return boolean
     */
    protected function shouldUpdateProgress(Employment $employment): bool
    {
        if ($employment->wasChanged('position_id') ||
            $employment->wasChanged('job_rank_id') ||
            $employment->wasChanged('job_status_id') ||
            $employment->wasChanged('grade') ||
            $employment->wasChanged('notch') ||
            $employment->wasChanged('start_date')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create employment record
     *
     * @param Employment $employment
     * @return void
     */
    protected function updateProgress(Employment $employment): void
    {
        $progress = $employment->progress()->latest()->first();
        if (empty($progress)) {
            $progress = new Progress();
            $progress->id = Str::uuid();
        }
        $this->progressData($progress, $employment, $employment->progressType);


    }

    /**
     * Change Employment Type
     *
     * @param Employment $employment
     * @return void
     */
    protected function changeEmploymentType(Employment $employment): void
    {
        if ($employment->isPermanent()) {

            // create new permanent employment
            $employment->revertToPermanent();

            // get previous non permanent position
            $previousPosition = $employment->getPreviousProgress();

            // check whether the position is really non-permanent
            if ($previousPosition->isNotPermanent()) {
                // deactivate non-permanent position
                // so that employee can assume new permanent position
                $previousPosition->deactivate();

                // create a history record for the new permanent position
                $this->createProgress($employment);
            }
        } else {
            // update existing non permanent employment
            $employment->revertToNonPermanent();
            $this->updateProgress($employment);
        }

    }

}

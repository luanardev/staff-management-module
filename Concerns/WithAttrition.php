<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Events\Dismissal;
use Lumis\StaffManagement\Events\Retirement;
use Lumis\StaffManagement\Events\Termination;

trait WithAttrition
{

    /**
     * Get appointments ending in a particular year
     *
     * @param string|null $year
     * @return mixed
     */
    public static function getProbation(string $year = null): mixed
    {
        if (empty($year)) {
            $year = Carbon::now()->year;
        }
        $type = JobType::Permanent();
        $status = JobStatus::Probation();

        return Employment::where('job_type_id', $type)
            ->where('job_status_id', $status)
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get contracts ending in a particular year
     *
     * @param string|null $year
     * @return mixed
     */
    public static function getTerminating(string $year = null): mixed
    {
        if (empty($year)) {
            $year = Carbon::now()->year;
        }
        $type = JobType::Permanent();
        $status = JobStatus::Serving();

        return Employment::where('job_type_id', '<>', $type)
            ->where('job_status_id', $status)
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get contracts ending today
     *
     * @return mixed
     */
    public static function getTerminatingToday(): mixed
    {
        $date = Carbon::today();
        $type = JobType::Permanent();
        $status = JobStatus::Serving();

        return Employment::where('job_type_id', '<>', $type)
            ->where('job_status_id', $status)
            ->where('end_date', '>=', $date)
            ->get();
    }

    /**
     * Get employees retiring in a particular year
     *
     * @param string|null $year
     * @return mixed
     */
    public static function getRetiring(string $year = null): mixed
    {
        if (empty($year)) {
            $year = Carbon::now()->year;
        }

        $type = JobType::Permanent();
        $status = JobStatus::Serving();

        return Employment::where('job_type_id', $type)
            ->where('job_status_id', $status)
            ->whereYear('end_date', $year)
            ->get();
    }

    /**
     * Get employees retiring today
     *
     * @return mixed
     */
    public static function getRetiringToday(): mixed
    {
        $date = Carbon::today();
        $type = JobType::Permanent();
        $status = JobStatus::Serving();

        return Employment::where('job_type_id', $type)
            ->where('job_status_id', $status)
            ->where('end_date', $date)
            ->get();
    }

    /**
     * Dismiss tenure
     *
     * @return void
     */
    public function dismissTenure(): void
    {
        $status = JobStatus::Dismissed();
        $this->setAttribute('job_status_id', $status);
        $this->setConfirmed(false);
        $this->saveQuietly();

        $this->quitCareer();

        Dismissal::dispatch($this->staff);
    }

    /**
     * End staff career
     *
     * @return void
     */
    protected function quitCareer(): void
    {
        $this->staff->deactivate();

        $this->staff->disableAccount();

        foreach ($this->progress()->get() as $progress) {
            $progress->deactivate();
        }
    }

    /**
     * Retire staff from work
     * @return void
     */
    public function retireFromWork(): void
    {
        $status = JobStatus::Retired();
        $this->setAttribute('job_status_id', $status);
        $this->saveQuietly();
        $this->quitCareer();

        Retirement::dispatch($this->staff);
    }

    /**
     * Terminate staff contract
     * @return void
     */
    public function terminateContract(): void
    {
        $status = JobStatus::Terminated();
        $this->setAttribute('job_status_id', $status);
        $this->saveQuietly();
        $this->quitCareer();

        Termination::dispatch($this->staff);
    }

    /**
     * Reinstate employee
     *
     * @return void
     */
    public function reinstateEmployment(): void
    {
        $status = JobStatus::Serving();
        $this->setAttribute('job_status_id', $status);
        $this->resumeCareer();
        $this->saveQuietly();
    }

    /**
     * Resume career progress
     *
     * @return void
     */
    protected function resumeCareer(): void
    {
        $this->staff->activate();

        $this->staff->enableAccount();

        $previousPost = $this->progress()->latest()->first();
        if (isset($previousPost)) {
            $previousPost->activate();
        }

    }

    /**
     * Check whether should stop career
     *
     * @return boolean
     */
    public function shouldQuitCareer(): bool
    {
        $statuses = JobStatus::getQuitingStatus();
        return in_array($this->job_status_id, $statuses);

    }

    /**
     * Check whether should resume career
     *
     * @return boolean
     */
    public function shouldResumeCareer(): bool
    {
        $statuses = JobStatus::getResumingStatus();
        return in_array($this->job_status_id, $statuses);

    }


}

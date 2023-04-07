<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Events\Confirmation;
use Lumis\StaffManagement\Facades\StaffConfig;

trait WithConfirmation
{
    /**
     * Set employment tenure
     *
     * @param string $startdate
     * @param string|null $enddate
     * @return self
     */
    public function setTenurePeriod(string $startdate, string $enddate = null): static
    {
        if (empty($enddate)) {
            if ($this->isPermanent() && $this->isConfirmed()) {
                $enddate = $this->permanentEndDate();
            } else {
                $enddate = $this->probationEndDate();
            }
        } else {
            $enddate = Carbon::createFromDate($enddate);
        }

        $this->setAttribute('start_date', $startdate);
        $this->setAttribute('end_date', $enddate);
        return $this;
    }

    /**
     * Check whether staff is appointed
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return strtolower($this->confirmation_status) == strtolower('Confirmed');
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function permanentEndDate(): Carbon
    {
        $retirementAge = (int)StaffConfig::get('retirement_age') ?? 60;
        return Carbon::createFromDate($this->staff->date_of_birth)
            ->addYears($retirementAge);
    }

    /**
     * Get retirement date
     *
     * @return Carbon
     */
    protected function probationEndDate(): Carbon
    {
        $probationPeriod = (int)StaffConfig::get('probation_period') ?? 12;
        return Carbon::createFromDate($this->start_date)
            ->addMonths($probationPeriod);
    }

    /**
     * Confirm employment
     * @param string $comment
     * @param string $confirmDate
     * @return void
     */
    public function confirmTenure(string $comment, string $confirmDate): void
    {
        if (empty($confirmDate)) {
            $confirmDate = Carbon::today();
        } else {
            $confirmDate = Carbon::createFromDate($confirmDate);
        }

        $status = JobStatus::Serving();
        $endDate = $this->permanentEndDate();

        $this->setAttribute('job_status_id', $status);
        $this->setAttribute('end_date', $endDate);
        $this->setAttribute('confirmation_date', $confirmDate);
        $this->setAttribute('confirmation_comment', $comment);
        $this->setConfirmed(true);
        $this->saveQuietly();

        Confirmation::dispatch($this->staff);

    }

    /**
     * Set confirmation status
     * @param bool $confirmed
     * @return self
     */
    public function setConfirmed(bool $confirmed = true): static
    {
        if ($confirmed) {
            $this->setAttribute('confirmation_status', 'Confirmed');
        } else {
            $this->setAttribute('confirmation_status', 'Unconfirmed');
            $this->setAttribute('confirmation_date', NULL);
        }
        return $this;
    }

    /**
     * Unconfirmed Tenure
     *
     * @return void
     */
    public function unconfirmTenure(): void
    {
        $status = JobStatus::Probation();
        $endDate = $this->probationEndDate();

        $this->setAttribute('job_status_id', $status);
        $this->setAttribute('end_date', $endDate);
        $this->setAttribute('confirmation_date', NULL);
        $this->setConfirmed(false);
        $this->saveQuietly();
    }

    /**
     * Revert to Non-permanent state
     *
     * @return void
     */
    public function revertToNonPermanent(): void
    {
        $status = JobStatus::Serving();
        $endDate = $this->probationEndDate();

        $this->setAttribute('job_status_id', $status);
        $this->setAttribute('end_date', $endDate);
        $this->setAttribute('confirmation_date', NULL);
        $this->setAttribute('confirmation_comment', NULL);
        $this->setConfirmed(false);
        $this->saveQuietly();
    }

    /**
     * Revert to permanent state
     *
     * @return void
     */
    public function revertToPermanent(): void
    {
        if ($this->isConfirmed()) {
            $this->setConfirmed(true);
            $status = JobStatus::Serving();
            $endDate = $this->permanentEndDate();
        } else {
            $this->setConfirmed(false);
            $status = JobStatus::Probation();
            $endDate = $this->probationEndDate();
        }

        $this->setAttribute('job_status_id', $status);
        $this->setAttribute('end_date', $endDate);

        $this->saveQuietly();
    }

    /**
     * Check whether staff is confirmed
     * @return bool
     */
    public function isNotConfirmed(): bool
    {
        return strtolower($this->confirmation_status) == strtolower('Unconfirmed');
    }

    /**
     * Staff confirmed date
     *
     * @return string|null
     */
    public function confirmationDate(): ?string
    {
        return (isset($this->confirmation_date)) ?
            $this->confirmation_date->format('d-M-Y') : null;
    }

    /**
     * Get years of service
     */
    public function confirmationPeriod(): string
    {
        return Carbon::createFromDate($this->confirmation_date)
            ->diff(Carbon::now())->format('%y');
    }

    /**
     * Status
     *
     * @return string
     */
    public function confirmationBadge(): string
    {
        return $this->isConfirmed() ?
            "<span class='badge badge-success'>Confirmed</span>" :
            "<span class='badge badge-danger'>Not Confirmed</span>";
    }


}

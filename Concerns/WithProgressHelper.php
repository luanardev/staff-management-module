<?php

namespace Lumis\StaffManagement\Concerns;

trait WithProgressHelper
{
    /**
     * @return string
     */
    public function getProgressType(): string
    {
        return $this->progressType->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->progressType->description;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position->name;
    }

    /**
     * @return string
     */
    public function getJobRank(): string
    {
        return $this->jobRank->name;
    }

    /**
     * @return string
     */
    public function getJobType(): string
    {
        return $this->jobType->name;
    }

    /**
     * @return string|null
     */
    public function getGrade(): ?string
    {
        return $this->grade ?? null;
    }

    /**
     * @return string|null
     */
    public function getGradeScale(): ?string
    {
        return isset($this->grade) ? "{$this->grade} - {$this->notch}" : null;
    }

    /**
     * @return bool
     */
    public function isAppointment(): bool
    {
        return $this->isProgressType('Appointment');
    }

    /**
     * @return bool
     */
    public function isDeanship(): bool
    {
        return $this->isProgressType('Deanship');
    }

    /**
     * @return bool
     */
    public function isHeadship(): bool
    {
        return $this->isProgressType('Headship');
    }

    /**
     * @return boolean
     */
    public function isTemporary(): bool
    {
        return $this->isProgressType('Temporary');
    }

    /**
     * @return bool
     */
    public function isNotContract(): bool
    {
        return !$this->isContract();
    }

    /**
     * @return bool
     */
    public function isContract(): bool
    {
        return $this->isProgressType('Contract');
    }

    /**
     * @return bool
     */
    public function isNotPermanent(): bool
    {
        return !$this->isPermanent();
    }

    /**
     * @return bool
     */
    public function isPermanent(): bool
    {
        return $this->isProgressType('Permanent');
    }

    /**
     * @return bool
     */
    public function isNotPromotion(): bool
    {
        return !$this->isPromotion();
    }

    /**
     * @return bool
     */
    public function isPromotion(): bool
    {
        return $this->isProgressType('Promotion');
    }

    /**
     * @return bool
     */
    public function isNotIncrement(): bool
    {
        return !$this->isIncrement();
    }

    /**
     * @return bool
     */
    public function isIncrement(): bool
    {
        return $this->isProgressType('Increment');
    }

    /**
     * @return bool
     */
    public function isNotActive(): bool
    {
        return !$this->isActive();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return strtolower($this->status) == strtolower('active');
    }

    /**
     * @param string $grade
     * @param int $notch
     */
    public function grading(string $grade, int $notch): void
    {
        $this->setAttribute('grade', $grade);
        $this->setAttribute('notch', $notch);
    }

    /**
     * Staff joining date
     *
     * @return string|null
     */
    public function startDate(): ?string
    {
        return (isset($this->start_date)) ? $this->start_date->format('d-M-Y') : null;

    }

    /**
     * Staff exit date
     *
     * @return string|null
     */
    public function endDate(): ?string
    {
        return (isset($this->end_date)) ? $this->end_date->format('d-M-Y') : null;

    }

    /**
     * Status
     *
     * @return string
     */
    public function jobStatusBadge(): string
    {
        return "<span class='badge badge-info'>{$this->getJobStatus()}</span>";
    }

    /**
     * @return string
     */
    public function getJobStatus(): string
    {
        return $this->jobStatus->name;
    }

    /**
     * Status
     *
     * @return string
     */
    public function statusBadge(): string
    {
        return (strtolower($this->status) == strtolower('active')) ?
            "<span class='badge badge-success'>Current</span>" :
            "<span class='badge badge-secondary'>Previous</span>";
    }

}

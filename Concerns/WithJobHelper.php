<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Support\Carbon;

trait WithJobHelper
{
    /**
     * Set serving status
     * @return self
     */
    public function setServing(): static
    {
        return $this->setJobStatus('Serving');
    }

    /**
     * Set permanent type
     * @return self
     */
    public function setPermanent(): static
    {
        return $this->setJobType('Permanent');
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotServing(): bool
    {
        return !$this->isServing();
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isServing(): bool
    {
        return $this->isJobStatus('Serving');
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isProbation(): bool
    {
        return $this->isJobStatus('Probation');
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotTerminated(): bool
    {
        return !$this->isTerminated();
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isTerminated(): bool
    {
        return $this->isJobStatus('Terminated');
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotPermanent(): bool
    {
        return !$this->isPermanent();
    }

    /**
     * Check whether staff is permanent
     * @return bool
     */
    public function isPermanent(): bool
    {
        return $this->isJobType('Permanent');
    }

    /**
     * @return bool
     */
    public function isNotAcademic(): bool
    {
        return !$this->isAcademic();
    }

    /**
     * Check whether staff is academic
     * @return bool
     */
    public function isAcademic(): bool
    {
        return $this->isJobCategory('Academic');
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isResearch(): bool
    {
        return $this->isJobCategory('Research');
    }

    /**
     * Check whether staff is administrative
     * @return bool
     */
    public function isAdministrative(): bool
    {
        return $this->isJobCategory('Administrative');
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isCTS(): bool
    {
        return $this->isJobCategory('CTS');
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getCampus(): ?string
    {
        return $this->campus->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getBranch(): ?string
    {
        return $this->branch->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getJobCategory(): ?string
    {
        return $this->jobCategory->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getJobType(): ?string
    {
        return $this->jobType->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getJobRank(): ?string
    {
        return $this->jobRank->name ?? null;
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
     * @return string|null
     */
    public function getProgressType(): ?string
    {
        return $this->progressType->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getProgressDescription(): ?string
    {
        return $this->progressType->description ?? null;
    }

    /**
     * Get either department or section
     *
     * @return string|null
     */
    public function getDivision(): ?string
    {
        if ($this->isAcademic()) {
            return isset($this->department_id) ? $this->getDepartment() : null;
        } else {
            return isset($this->section_id) ? $this->getSection() : null;
        }
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department->name ?? null;
    }

    /**
     * @return string|null
     */
    public function getSection(): ?string
    {
        return $this->section->name ?? null;
    }

    /**
     * Get years of service
     * @return String|null
     */
    public function elapsedPeriod(): ?string
    {
        return isset($this->start_date) ?
            Carbon::createFromDate($this->start_date)
                ->diff(Carbon::now())
                ->format('%y Years, %m Months') : null;
    }

    /**
     * Get remaining years of service
     * @return String|null
     */
    public function remainingPeriod(): ?string
    {
        return isset($this->end_date) ?
            Carbon::createFromDate(Carbon::now())
                ->diff($this->end_date)
                ->format('%y Years, %m Months') : null;
    }

    /**
     * Get contract period
     * @return String|null
     */
    public function contractPeriod(): ?string
    {
        return isset($this->start_date) && isset($this->end_date) ?
            Carbon::createFromDate($this->start_date)
                ->diff($this->end_date)
                ->format('%y Years, %m Months') : null;
    }

    /**
     * Staff joining date
     *
     * @return String|null
     */
    public function startDate(): ?string
    {
        return (isset($this->start_date)) ?
            $this->start_date->format('d-M-Y') : null;

    }

    /**
     * Staff exit date
     *
     * @return string|null
     */
    public function endDate(): ?string
    {
        return (isset($this->end_date)) ?
            $this->end_date->format('d-M-Y') : null;
    }

    /**
     * Status
     *
     * @return string
     */
    public function statusBadge(): string
    {
        return $this->isServing() ?
            "<span class='badge badge-success'>{$this->getJobStatus()}</span>" :
            "<span class='badge badge-danger'>{$this->getJobStatus()}</span>";
    }

    /**
     * @return string|null
     */
    public function getJobStatus(): ?string
    {
        return $this->jobStatus->name ?? null;
    }
}

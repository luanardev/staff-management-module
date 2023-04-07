<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobRank;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Entities\Position;
use Lumis\StaffManagement\Entities\ProgressType;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\Organization\Entities\Branch;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;

/**
 * @property Campus $campus
 * @property Branch $branch
 * @property Department $department
 * @property Section $section
 * @property Staff $staff
 * @property Position $position
 * @property JobType $jobType
 * @property JobCategory $jobCategory
 * @property JobRank $jobRank
 * @property JobStatus $jobStatus
 * @property ProgressType $progressType
 */
trait HasEmployment
{

    /**
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->employment->position();
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->employment->department();
    }

    /**
     * @return BelongsTo
     */
    public function section(): BelongsTo
    {
        return $this->employment->section();
    }

    /**
     * @return BelongsTo
     */
    public function campus(): BelongsTo
    {
        return $this->employment->campus();
    }

    /**
     * @return BelongsTo
     */
    public function jobCategory(): BelongsTo
    {
        return $this->employment->jobCategory();
    }

    /**
     * @return BelongsTo
     */
    public function jobType(): BelongsTo
    {
        return $this->employment->jobType();
    }

    /**
     * @return BelongsTo
     */
    public function jobRank(): BelongsTo
    {
        return $this->employment->jobRank();
    }

    /**
     * @return BelongsTo
     */
    public function progressType(): BelongsTo
    {
        return $this->employment->progressType();
    }

    /**
     * Check staff status
     *
     * @param string $status
     * @return boolean
     */
    public function isJobStatus(string $status): bool
    {
        return $this->employment->isJobStatus($status);
    }

    /**
     * Check staff type
     *
     * @param string $type
     * @return boolean
     */
    public function isJobType(string $type): bool
    {
        return $this->employment->isJobType($type);
    }

    /**
     * Check staff category
     *
     * @param string $category
     * @return boolean
     */
    public function isJobCategory(string $category): bool
    {
        return $this->employment->isJobCategory($category);
    }

    /**
     * Check staff type
     *
     * @param string $type
     * @return boolean
     */
    public function isProgressType(string $type): bool
    {
        return $this->employment->isProgressType($type);
    }

    /**
     * Check whether staff is permanent
     * @return bool
     */
    public function isPermanent(): bool
    {
        return $this->employment->isPermanent();
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotPermanent(): bool
    {
        return $this->employment->isNotPermanent();
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isTerminated(): bool
    {
        return $this->employment->isTerminated();
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isNotTerminated(): bool
    {
        return $this->employment->isNotTerminated();
    }

    /**
     * Check whether staff is serving
     * @return bool
     */
    public function isServing(): bool
    {
        return $this->employment->isServing();
    }

    /**
     * Check whether staff is not permanent
     * @return bool
     */
    public function isNotServing(): bool
    {
        return $this->employment->isNotServing();
    }

    /**
     * Check wether staff is appointed
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->employment->isConfirmed();
    }

    /**
     * Check wether staff is confirmed
     * @return bool
     */
    public function isNotConfirmed(): bool
    {
        return $this->employment->isNotConfirmed();
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isResearch(): bool
    {
        return $this->employment->isResearch();
    }

    /**
     * Check whether staff is administrative
     * @return bool
     */
    public function isAdministrative(): bool
    {
        return $this->employment->isAdministrative();
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isCTS(): bool
    {
        return $this->employment->isCTS();
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isClerical(): bool
    {
        return $this->employment->isClerical();
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isTechnical(): bool
    {
        return $this->employment->isTechnical();
    }

    /**
     * Check whether staff is support
     * @return bool
     */
    public function isSupport(): bool
    {
        return $this->employment->isSupport();
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        if ($this->position) {
            return $this->position->name;
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getCampus(): ?string
    {
        if ($this->campus) {
            return $this->campus->name;
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getBranch(): ?string
    {
        if ($this->branch) {
            return $this->branch->name;
        } else {
            return null;
        }
    }

    /**
     *
     * @return string
     */
    public function getJobRank(): string
    {
        return $this->jobRank->name;
    }

    /**
     *
     * @return string
     */
    public function getGrade(): string
    {
        return $this->employment->grade;
    }

    /**
     * @return string
     */
    public function getJobCategory(): string
    {
        return $this->jobCategory->name;
    }

    /**
     * @return string
     */
    public function getJobType(): string
    {
        return $this->jobType->name;
    }

    /**
     * @return string
     */
    public function getJobStatus(): string
    {
        return $this->jobStatus->name;
    }

    /**
     * @return string
     */
    public function getProgressType(): string
    {
        return $this->progressType->name;
    }

    /**
     * Get either department or section
     *
     * @return string|null
     */
    public function getDivision(): ?string
    {
        if ($this->isAcademic()) {
            return isset($this->employment->department_id) ? $this->getDepartment() : null;
        } else {
            return isset($this->employment->section_id) ? $this->getSection() : null;
        }
    }

    /**
     * Check whether staff is academic
     * @return bool
     */
    public function isAcademic(): bool
    {
        return $this->employment->isAcademic();
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        if ($this->department) {
            return $this->department->name;
        } else {
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getSection(): ?string
    {
        if ($this->section) {
            return $this->section->name;
        } else {
            return null;
        }
    }

    /**
     * Get years of service
     */
    public function confirmationPeriod(): string
    {
        return $this->employment->confirmationPeriod();
    }

    /**
     * Get years of service
     */
    public function elapsedPeriod(): ?string
    {
        return $this->employment->elapsedPeriod();
    }

    /**
     * Get remaining years of service
     */
    public function remainingPeriod(): ?string
    {
        return $this->employment->remainingPeriod();
    }

    /**
     * Staff joining date
     *
     * @return string
     */
    public function startDate(): string
    {
        return $this->employment->startDate();

    }

    /**
     * Staff confirmed date
     *
     * @return string
     */
    public function confirmationDate(): string
    {
        return $this->employment->confirmationDate();

    }

    /**
     * Staff exit date
     *
     * @return string
     */
    public function endDate(): string
    {
        return $this->employment->endDate();
    }


}

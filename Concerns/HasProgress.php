<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\ProgressType;

trait HasProgress
{
    /**
     * Get progressions ordered by status
     *
     * @return Collection
     */
    public function orderedProgress(): Collection
    {
        return $this->progress()->orderBy('status')->latest()->get();
    }

    /**
     * @return HasMany
     */
    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class, 'staff_id');
    }

    /**
     * Get previous career record
     *
     * @return Progress
     */
    public function getPreviousProgress(): Progress
    {
        return $this->progress()->latest()->first();
    }

    /**
     * Get previous promotion record
     *
     * @return bool
     */
    public function wasPromoted(): bool
    {
        $promotion = $this->getLastPromotion();
        return !empty($promotion);
    }

    /**
     * Get previous promotion record
     *
     * @return Progress
     */
    public function getLastPromotion(): Progress
    {
        $promotion = ProgressType::Promotion();
        $increment = ProgressType::Incremental();
        return $this->progress()
            ->where('progress_type_id', $promotion)
            ->orWhere('progress_type_id', $increment)
            ->latest()
            ->first();
    }

    /**
     * Get previous promotion period
     *
     * @return integer
     */
    public function getLastPromotionPeriod(): int
    {
        $promotion = $this->getLastPromotion();
        return Carbon::createFromDate($promotion->start_date)
            ->diff(Carbon::now())->format('%y');
    }

    /**
     * Get active appointment record
     *
     * @return Progress
     */
    public function getAppointment(): Progress
    {
        $type = ProgressType::Appointment();
        return $this->progress()
            ->where('progress_type_id', $type)
            ->latest()
            ->first();
    }

}

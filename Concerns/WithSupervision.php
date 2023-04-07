<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Entities\Supervision;

/**
 * @property Staff $supervisor
 * @property Collection subordinates
 */
trait WithSupervision
{

    /**
     * @param Staff $supervisor
     * @return bool
     */
    public function setSupervisorOnce(mixed $supervisor): bool
    {
        $supervision = new Supervision();
        if ($this->hasSupervisor()) {
            $supervision->remove($this->supervisor, $this);
        }
        return $supervision->add($supervisor, $this);
    }

    /**
     * @return bool
     */
    public function hasSupervisor(): bool
    {
        return $this->isSubordinate();
    }

    /**
     * @return bool
     */
    public function isSubordinate(): bool
    {
        $supervision = new Supervision();
        return $supervision->isSubordinate($this);
    }

    /**
     * @param Staff $supervisor
     * @return bool
     */
    public function setSupervisor(mixed $supervisor): bool
    {
        $supervision = new Supervision();
        return $supervision->add($supervisor, $this);
    }

    /**
     * @param Staff $supervisor
     * @return bool
     */
    public function removeSupervisor(mixed $supervisor): bool
    {
        $supervision = new Supervision();
        return $supervision->remove($supervisor, $this);
    }

    /**
     * @return HasOneThrough
     */
    public function supervisor(): HasOneThrough
    {
        return $this->hasOneThrough(Staff::class, Supervision::class, 'subordinate_id', 'id', 'id', 'supervisor_id');
    }

    /**
     * @return HasManyThrough
     */
    public function subordinates(): HasManyThrough
    {
        return $this->hasManyThrough(Staff::class, Supervision::class, 'supervisor_id', 'id', 'id', 'subordinate_id');
    }

    /**
     * @return bool
     */
    public function hasSubordinate(): bool
    {
        return $this->isSupervisor();
    }

    /**
     * @return bool
     */
    public function isSupervisor(): bool
    {
        $supervision = new Supervision();
        return $supervision->isSupervisor($this);
    }


}

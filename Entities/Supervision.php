<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $supervisor_id
 * @property mixed $subordinate_id
 * @property Staff $supervisor
 * @property Staff $subordinate
 */
class Supervision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_supervision';

    /**
     * @var array
     */
    protected $fillable = ['supervisor_id', 'subordinate_id'];

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $supervisor
     * @param Staff $subordinate
     */
    public function add(mixed $supervisor, mixed $subordinate): bool
    {
        $this->supervisor()->associate($supervisor);
        $this->subordinate()->associate($subordinate);
        return $this->save();
    }

    /**
     * @return BelongsTo
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'supervisor_id');
    }

    /**
     * @return BelongsTo
     */
    public function subordinate(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'subordinate_id');
    }

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $supervisor
     * @param Staff $subordinate
     * @return bool
     */
    public function remove(mixed $supervisor, mixed $subordinate): bool
    {
        if ($supervisor instanceof Staff) {
            $supervisor = $supervisor->getKey();
        }
        if ($subordinate instanceof Staff) {
            $subordinate = $subordinate->getKey();
        }
        return static::where('supervisor_id', $supervisor)
            ->where('subordinate_id', $subordinate)
            ->delete();
    }

    /**
     * Check whether Staff is Supervisor
     * @param Staff $staff
     * @return boolean
     */
    public function isSupervisor(mixed $staff): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('supervisor_id', $staff)->exists();
    }

    /**
     * Check whether Staff is Subordinate
     * @param Staff $staff
     * @return boolean
     */
    public function isSubordinate(mixed $staff): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('subordinate_id', $staff)->exists();
    }


}

<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property mixed $department_id
 * @property mixed $campus_id
 * @property string $start_date
 * @property string $end_date
 * @property Staff $staff
 * @property Department $department
 * @property Campus $campus
 */
class Headship extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_supervisor_department';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['id', 'staff_id', 'department_id', 'campus_id', 'position', 'start_date', 'end_date'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    /**
     *
     * @param Staff $staff
     * @return null|Headship
     */
    public static function getStaff(mixed $staff): null|Headship
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)->first();
    }

    /**
     * @return array
     */
    public static function positions(): array
    {
        return [
            'Head' => 'Head of Department',
            'Deputy' => 'Deputy Head of Department'
        ];
    }

    /**
     * Assign headship
     *
     * @param Staff $staff
     * @param Department $department
     * @param Campus $campus
     * @param string $position
     * @param string $startdate
     * @param string $enddate
     * @return void
     */
    public function add(mixed $staff, mixed $department, mixed $campus, string $position, string $startdate, string $enddate): void
    {
        $this->staff()->associate($staff);
        $this->department()->associate($department);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->setAttribute('start_date', $startdate);
        $this->setAttribute('end_date', $enddate);
        $this->save();
    }

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * @return BelongsTo
     */
    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Replace headship
     *
     * @param Staff $staff
     * @param Department $department
     * @param Campus $campus
     * @param string $position
     * @param string $startdate
     * @param string $enddate
     * @return void
     */
    public function replace(mixed $staff, mixed $department, mixed $campus, string $position, string $startdate, string $enddate): void
    {
        if ($this->isAssigned($department, $campus, $position)) {
            $this->remove($staff, $department, $campus);
        }

        $this->staff()->associate($staff);
        $this->department()->associate($department);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->setAttribute('start_date', $startdate);
        $this->setAttribute('end_date', $enddate);
        $this->save();
    }

    /**
     * @param Department $department
     * @param Campus $campus
     * @param string $position
     * @return boolean
     */
    public function isAssigned(mixed $department, mixed $campus, string $position): bool
    {
        if ($department instanceof Department) {
            $department = $department->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->exists();
    }

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $staff
     * @param Department $department
     * @param Campus $campus
     * @return boolean
     */
    public function remove(mixed $staff, mixed $department, mixed $campus): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        if ($department instanceof Department) {
            $department = $department->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('department_id', $department)
            ->where('campus_id', $campus)
            ->delete();
    }

    /**
     *
     * @param Department $department
     * @param Campus $campus
     * @param string $position
     * @return void
     */
    public function search(mixed $department, mixed $campus, string $position)
    {
        if ($department instanceof Department) {
            $department = $department->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->first();
    }

    /**
     * @param Staff $staff
     * @return boolean
     */
    public function isHead(mixed $staff): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param Staff $staff
     * @return boolean
     */
    public function isDeputy(mixed $staff): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Deputy')
            ->exists();
    }

    /**
     * @param Department $department
     * @param Campus $campus
     * @return boolean
     */
    public function hasHead(mixed $department, mixed $campus): bool
    {
        if ($department instanceof Department) {
            $department = $department->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param Department $department
     * @param Campus $campus
     * @return boolean
     */
    public function hasDeputy(mixed $department, mixed $campus): bool
    {
        if ($department instanceof Department) {
            $department = $department->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('department_id', $department)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

}

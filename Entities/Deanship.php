<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Faculty;

/**
 * @property mixed $id
 * @property mixed $faculty_id
 * @property mixed $campus_id
 * @property string $position
 * @property string $start_date
 * @property string $end_date
 * @property Staff $staff
 * @property Faculty $faculty
 * @property Campus $campus
 */
class Deanship extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_supervisor_faculty';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'faculty_id', 'campus_id', 'position', 'start_date', 'end_date'];

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
     * @return Deanship
     */
    public static function getStaff(mixed $staff): Deanship
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
            'Dean' => 'Dean of Faculty',
            'Deputy' => 'Deputy Dean of Faculty'
        ];
    }

    /**
     * Assign deanship
     *
     * @param Staff $staff
     * @param Faculty $faculty
     * @param Campus $campus
     * @param string $position
     * @param string $startdate
     * @param string $enddate
     * @return void
     */
    public function add(mixed $staff, mixed $faculty, mixed $campus, string $position, string $startdate, string $enddate): void
    {
        $this->staff()->associate($staff);
        $this->faculty()->associate($faculty);
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
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    /**
     * @return BelongsTo
     */
    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Replace deanship
     *
     * @param Staff $staff
     * @param Faculty $faculty
     * @param Campus $campus
     * @param string $position
     * @param string $startdate
     * @param string $enddate
     * @return void
     */
    public function replace(mixed $staff, mixed $faculty, mixed $campus, string $position, string $startdate, string $enddate): void
    {
        if ($this->isAssigned($faculty, $campus, $position)) {
            $this->remove($staff, $faculty, $campus);
        }

        $this->staff()->associate($staff);
        $this->faculty()->associate($faculty);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->setAttribute('start_date', $startdate);
        $this->setAttribute('end_date', $enddate);
        $this->save();
    }

    /**
     * @param Faculty $faculty
     * @param Campus $campus
     * @param string $position
     * @return boolean
     */
    public function isAssigned(mixed $faculty, mixed $campus, string $position): bool
    {
        if ($faculty instanceof Faculty) {
            $faculty = $faculty->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->exists();
    }

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $staff
     * @param Faculty $faculty
     * @param Campus $campus
     * @return bool
     */
    public function remove(mixed $staff, mixed $faculty, mixed $campus): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        if ($faculty instanceof Faculty) {
            $faculty = $faculty->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->delete();
    }

    /**
     *
     * @param Faculty $faculty
     * @param Campus $campus
     * @param string $position
     * @return Deanship
     */
    public function search(mixed $faculty, mixed $campus, string $position): Deanship
    {
        if ($faculty instanceof Faculty) {
            $faculty = $faculty->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->first();
    }

    /**
     * @param Staff $staff
     * @return boolean
     */
    public function isDean(mixed $staff): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('position', 'Dean')
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
     * @param Faculty $faculty
     * @param Campus $campus
     * @return boolean
     */
    public function hasDean(mixed $faculty, mixed $campus): bool
    {
        if ($faculty instanceof Faculty) {
            $faculty = $faculty->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', 'Dean')
            ->exists();
    }

    /**
     * @param Faculty $faculty
     * @param Campus $campus
     * @return boolean
     */
    public function hasDeputy(mixed $faculty, mixed $campus): bool
    {
        if ($faculty instanceof Faculty) {
            $faculty = $faculty->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('faculty_id', $faculty)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

}

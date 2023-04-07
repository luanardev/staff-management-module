<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Section;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property mixed $section_id
 * @property mixed $campus_id
 * @property string $position
 * @property Staff $staff
 * @property Section $section
 * @property Campus $campus
 */
class Managership extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_supervisor_section';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'section_id', 'campus_id', 'position'];

    /**
     *
     * @param Staff $staff
     * @return Managership
     */
    public static function getStaff(mixed $staff): Managership
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
            'Head' => 'Head of Section',
            'Deputy' => 'Deputy Head of Section'
        ];
    }

    /**
     * Assign manager
     *
     * @param Staff $staff
     * @param Section $section
     * @param Campus $campus
     * @param string $position
     * @return void
     */
    public function add(mixed $staff, mixed $section, mixed $campus, string $position): void
    {
        $this->staff()->associate($staff);
        $this->section()->associate($section);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
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
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    /**
     * @return BelongsTo
     */
    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Replace manager
     *
     * @param Staff $staff
     * @param Section $section
     * @param Campus $campus
     * @param string $position
     * @return void
     */
    public function replace(mixed $staff, mixed $section, mixed $campus, string $position): void
    {
        if ($this->isAssigned($section, $campus, $position)) {
            $this->remove($staff, $section, $campus);
        }
        $this->staff()->associate($staff);
        $this->section()->associate($section);
        $this->campus()->associate($campus);
        $this->setAttribute('position', $position);
        $this->save();
    }

    /**
     * @param Section $section
     * @param Campus $campus
     * @param string $position
     * @return boolean
     */
    public function isAssigned(mixed $section, mixed $campus, string $position): bool
    {
        if ($section instanceof Section) {
            $section = $section->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
            ->where('campus_id', $campus)
            ->where('position', $position)
            ->exists();
    }

    /**
     * Link Staff to Model in Polymorphic relationship
     *
     * @param Staff $staff
     * @param Section $section
     * @param Campus $campus
     * @return boolean
     */
    public function remove(mixed $staff, mixed $section, mixed $campus): bool
    {
        if ($staff instanceof Staff) {
            $staff = $staff->getKey();
        }
        if ($section instanceof Section) {
            $section = $section->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('staff_id', $staff)
            ->where('section_id', $section)
            ->where('campus_id', $campus)
            ->delete();
    }

    /**
     * @param Staff $staff
     * @return boolean
     */
    public function isManager(mixed $staff): bool
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
     * @param Section $section
     * @param Campus $campus
     * @return boolean
     */
    public function hasManager(mixed $section, mixed $campus): bool
    {
        if ($section instanceof Section) {
            $section = $section->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
            ->where('campus_id', $campus)
            ->where('position', 'Head')
            ->exists();
    }

    /**
     * @param Section $section
     * @param Campus $campus
     * @return boolean
     */
    public function hasDeputy(mixed $section, mixed $campus): bool
    {
        if ($section instanceof Section) {
            $section = $section->getKey();
        }
        if ($campus instanceof Campus) {
            $campus = $campus->getKey();
        }
        return static::where('section_id', $section)
            ->where('campus_id', $campus)
            ->where('position', 'Deputy')
            ->exists();
    }

}

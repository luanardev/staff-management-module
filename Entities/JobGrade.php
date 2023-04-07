<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $id
 * @property string $name
 * @property integer $level
 * @property integer $leave_days
 * @property Collection $notches
 */
class JobGrade extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_grade';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'level', 'leave_days'];

    /**
     * @param string $currentGrade
     * @param JobCategory $jobCategory
     * @return JobGrade
     */
    public static function getNextGradeInCategory(string $currentGrade, mixed $jobCategory): JobGrade
    {
        return static::getNextGradeInRange(
            $currentGrade,
            $jobCategory->start_grade,
            $jobCategory->end_grade
        );

    }

    /**
     * @param string $currentGrade
     * @param string $startGrade
     * @param string $endGrade
     * @return JobGrade
     */
    public static function getNextGradeInRange(string $currentGrade, string $startGrade, string $endGrade): JobGrade
    {
        $currentGradeLevel = static::where('name', $currentGrade)->pluck('level')->first();
        $startGradeLevel = static::where('name', $startGrade)->pluck('level')->first();
        $endGradeLevel = static::where('name', $endGrade)->pluck('level')->first();

        return static::where('level', '>=', $startGradeLevel)
            ->where('level', '<=', $endGradeLevel)
            ->where('level', '>', $currentGradeLevel)
            ->orderBy('level')
            ->limit(1)
            ->pluck('name')
            ->first();
    }

    /**
     * @return HasMany
     */
    public function notches(): HasMany
    {
        return $this->hasMany(JobNotch::class, 'grade');
    }

    /**
     * @return integer
     */
    public function leaveDays(): int
    {
        return $this->getAttribute('leave_days');
    }

}

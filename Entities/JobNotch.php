<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $id
 * @property string $grade
 * @property integer $notch
 */
class JobNotch extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_notch';

    /**
     * @var array
     */
    protected $fillable = ['grade', 'notch'];

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get notches by grade
     *
     * @param mixed $grade
     * @return Builder
     */
    public static function getByGrade(mixed $grade): Builder
    {
        return static::where('grade', $grade);
    }

    /**
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(JobGrade::class, 'grade');
    }


}

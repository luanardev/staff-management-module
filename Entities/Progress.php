<?php

namespace Lumis\StaffManagement\Entities;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Lumis\StaffManagement\Concerns\WithProgressHelper;
use Lumis\StaffManagement\Concerns\WithQuietUpdate;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property mixed $position_id
 * @property mixed $job_type_id
 * @property mixed $job_category_id
 * @property mixed $job_status_id
 * @property mixed $job_rank_id
 * @property mixed $progress_type_id
 * @property string $grade
 * @property integer $notch
 * @property string $status
 * @property string $start_date
 * @property string $end_date
 * @property Staff $staff
 * @property Position $position
 * @property JobType $jobType
 * @property JobCategory $jobCategory
 * @property JobRank $jobRank
 * @property JobStatus $jobStatus
 * @property ProgressType $progressType
 */
class Progress extends Model
{
    use WithQuietUpdate, WithProgressHelper, Loggable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_progress';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'position_id', 'job_rank_id', 'job_type_id', 'job_status_id', 'progress_type_id', 'grade', 'notch', 'status', 'start_date', 'end_date'];

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
     * Create Progression
     *
     * @param Staff $staff
     * @param ProgressType $progressType
     * @param Position $position
     * @param JobRank $jobRank
     * @param JobType $jobType
     * @param JobStatus $jobStatus
     * @param string $grade
     * @param integer $notch
     * @param string $startdate
     * @param string $enddate
     * @return void
     */
    public static function make(mixed $staff, mixed $progressType, mixed $position, mixed $jobRank, mixed $jobType, mixed $jobStatus, string $grade, int $notch, string $startdate, string $enddate): void
    {
        $progress = new Progress();
        $progress->id = Str::uuid();
        $progress->staff()->associate($staff);
        $progress->position()->associate($position);
        $progress->jobRank()->associate($jobRank);
        $progress->jobType()->associate($jobType);
        $progress->jobStatus()->associate($jobStatus);
        $progress->progressType()->associate($progressType);
        $progress->grade = $grade;
        $progress->notch = $notch;
        $progress->start_date = $startdate;
        $progress->end_date = $enddate;
        $progress->save();


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
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * @return BelongsTo
     */
    public function jobRank(): BelongsTo
    {
        return $this->belongsTo(JobRank::class, 'job_rank_id');
    }

    /**
     * @return BelongsTo
     */
    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function jobStatus(): BelongsTo
    {
        return $this->belongsTo(JobStatus::class, 'job_status_id');
    }

    /**
     * @return BelongsTo
     */
    public function progressType(): BelongsTo
    {
        return $this->belongsTo(ProgressType::class, 'progress_type_id');
    }

    /**
     * Activate progression
     */
    public function activate()
    {
        $this->setAttribute('status', 'Active');
        $this->saveQuietly();
    }

    /**
     * Deactivate progression
     */
    public function deactivate()
    {
        $this->setAttribute('status', 'Inactive');
        $this->saveQuietly();
    }

    /**
     * Check Progress type
     *
     * @param mixed $type
     * @return boolean
     */
    public function isProgressType(mixed $type): bool
    {
        if (is_string($type)) {
            $progress_type = $this->getProgressType();
            return strtolower($progress_type) == strtolower($type);
        } elseif (is_numeric($type)) {
            return $this->progress_type_id == $type;
        } elseif ($type instanceof ProgressType) {
            return $this->progress_type_id == $type->id;
        } else {
            return false;
        }
    }

    /**
     * Check job rank
     *
     * @param mixed $rank
     * @return boolean
     */
    public function isJobRank(mixed $rank): bool
    {
        if (is_string($rank)) {
            $rank = JobRank::findKey($rank);
            return $this->job_rank_id == $rank;
        } elseif (is_numeric($rank)) {
            return $this->job_rank_id == $rank;
        } elseif ($rank instanceof JobRank) {
            return $this->job_rank_id == $rank->getKey();
        } else {
            return false;
        }

    }

    /**
     * Check job type
     *
     * @param mixed $type
     * @return boolean
     */
    public function isJobType(mixed $type): bool
    {
        if (is_string($type)) {
            $type = JobType::findKey($type);
            return $this->job_type_id == $type;
        } elseif (is_numeric($type)) {
            return $this->job_type_id == $type;
        } elseif ($type instanceof JobType) {
            return $this->job_type_id == $type->getKey();
        } else {
            return false;
        }

    }

    /**
     * Check job status
     *
     * @param mixed $status
     * @return boolean
     */
    public function isJobStatus(mixed $status): bool
    {
        if (is_string($status)) {
            $status = JobStatus::findKey($status);
            return $this->job_status_id == $status;
        } elseif (is_numeric($status)) {
            return $this->job_status_id == $status;
        } elseif ($status instanceof JobStatus) {
            return $this->job_status_id == $status->getKey();
        } else {
            return false;
        }

    }

}

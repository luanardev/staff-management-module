<?php

namespace Lumis\StaffManagement\Entities;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Lumis\StaffManagement\Concerns\HasProgress;
use Lumis\StaffManagement\Concerns\WithAppointment;
use Lumis\StaffManagement\Concerns\WithAttrition;
use Lumis\StaffManagement\Concerns\WithConfirmation;
use Lumis\StaffManagement\Concerns\WithJobHelper;
use Lumis\StaffManagement\Concerns\WithQuietUpdate;
use Lumis\Organization\Entities\Branch;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;

/**
 * @property mixed $staff_id
 * @property mixed $campus_id
 * @property mixed $branch_id
 * @property mixed $department_id
 * @property mixed $section_id
 * @property mixed $position_id
 * @property mixed $job_type_id
 * @property mixed $job_category_id
 * @property mixed $job_status_id
 * @property mixed $job_rank_id
 * @property mixed $progress_type_id
 * @property string $grade
 * @property integer $notch
 * @property string $start_date
 * @property string $end_date
 * @property string $confirmation_status
 * @property string $confirmation_date
 * @property string $confirmation_comment
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
class Employment extends Model
{
    use HasProgress,
        WithQuietUpdate,
        WithAppointment,
        WithConfirmation,
        WithAttrition,
        WithJobHelper,
        HasFactory,
        Notifiable,
        Loggable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_employment';
    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'staff_id';
    /**
     * @var array
     */
    protected $fillable = [
        'staff_id', 'branch_id', 'campus_id', 'department_id', 'section_id',
        'position_id', 'job_type_id', 'job_category_id', 'job_status_id', 'job_rank_id', 'progress_type_id',
        'grade', 'notch', 'start_date', 'end_date', 'confirmation_status', 'confirmation_date', 'confirmation_comment'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'confirmation_date' => 'date:Y-m-d'
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * Set Primary Key
     * @param mixed $key
     * @return void
     */
    public function setKey(mixed $key): void
    {
        $this->setAttribute($this->primaryKey, $key);
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
    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    /**
     * @return JobGrade
     */
    public function jobGrade(): JobGrade
    {
        return JobGrade::where('name', $this->getGrade())->first();
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
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Set employment status
     * @param mixed $rank
     * @return self
     */
    public function setJobRank(mixed $rank): static
    {
        if (is_string($rank)) {
            $rank = JobRank::findKey($rank);
            $this->setAttribute('job_rank_id', $rank);
        } elseif (is_numeric($rank)) {
            $this->setAttribute('job_rank_id', $rank);
        } elseif ($rank instanceof JobRank) {
            $this->setAttribute('job_rank_id', $rank->getKey());
        }
        return $this;
    }

    /**
     * Set employment status
     * @param mixed $status
     * @return self
     */
    public function setJobStatus(mixed $status): static
    {
        if (is_string($status)) {
            $status = JobStatus::findKey($status);
            $this->setAttribute('job_status_id', $status);
        } elseif (is_numeric($status)) {
            $this->setAttribute('job_status_id', $status);
        } elseif ($status instanceof JobStatus) {
            $this->setAttribute('job_status_id', $status->getKey());
        }
        return $this;
    }

    /**
     * Set employment type
     * @param mixed $type
     * @return self
     */
    public function setJobType(mixed $type): static
    {
        if (is_string($type)) {
            $type = JobType::findKey($type);
            $this->setAttribute('job_type_id', $type);
        } elseif (is_numeric($type)) {
            $this->setAttribute('job_type_id', $type);
        } elseif ($type instanceof JobType) {
            $this->setAttribute('job_type_id', $type->getKey());
        }
        return $this;
    }

    /**
     * Set employment category
     * @param mixed $category
     * @return self
     */
    public function setJobCategory(mixed $category): static
    {
        if (is_string($category)) {
            $category = JobCategory::findKey($category);
            $this->setAttribute('job_category_id', $category);
        } elseif (is_numeric($category)) {
            $this->setAttribute('job_category_id', $category);
        } elseif ($category instanceof JobCategory) {
            $this->setAttribute('job_category_id', $category->getKey());
        }
        return $this;
    }

    /**
     * Set progress type
     * @param mixed $type
     * @return self
     */
    public function setProgressType(mixed $type): static
    {
        if (is_string($type)) {
            $type = ProgressType::findKey($type);
            $this->setAttribute('progress_type_id', $type);
        } elseif (is_numeric($type)) {
            $this->setAttribute('progress_type_id', $type);
        } elseif ($type instanceof ProgressType) {
            $this->setAttribute('progress_type_id', $type->getKey());
        }
        return $this;
    }

    /**
     * Check staff rank
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
     * Check staff status
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

    /**
     * Check staff type
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
     * Check staff category
     *
     * @param mixed $category
     * @return boolean
     */
    public function isJobCategory(mixed $category): bool
    {
        if (is_string($category)) {
            $category = JobCategory::findKey($category);
            return $this->job_category_id == $category;
        } elseif (is_numeric($category)) {
            return $this->job_category_id == $category;
        } elseif ($category instanceof JobCategory) {
            return $this->job_category_id == $category->getKey();
        } else {
            return false;
        }
    }

    /**
     * Check staff type
     *
     * @param mixed $type
     * @return boolean
     */
    public function isProgressType(mixed $type): bool
    {
        if (is_string($type)) {
            $type = ProgressType::findKey($type);
            return $this->progress_type_id == $type;
        } elseif (is_numeric($type)) {
            return $this->progress_type_id == $type;
        } elseif ($type instanceof ProgressType) {
            return $this->progress_type_id == $type->getKey();
        } else {
            return false;
        }
    }

    /**
     * Update Employment Post
     *
     * @param mixed $position
     * @param mixed $jobRank
     * @param mixed $jobType
     * @param mixed $jobStatus
     * @param mixed $progressType
     * @param string $grade
     * @param integer $notch
     * @param string|null $startdate
     * @param string|null $enddate
     * @return bool
     */
    public function updateJobPost(mixed $position, mixed $jobRank, mixed $jobType, mixed $jobStatus, mixed $progressType, string $grade, int $notch, string $startdate = null, string $enddate = null): bool
    {
        return $this->setPosition(
            $position, $jobRank, $jobType, $jobStatus,
            $progressType, $grade, $notch, $startdate, $enddate
        )->saveQuietly();
    }

    /**
     * Set Employment Post
     *
     * @param mixed $position
     * @param mixed $jobRank
     * @param mixed $jobType
     * @param mixed $jobStatus
     * @param mixed $progressType
     * @param string $grade
     * @param integer $notch
     * @param string|null $startdate
     * @param string|null $enddate
     * @return Employment
     */
    public function setPosition(mixed $position, mixed $jobRank, mixed $jobType, mixed $jobStatus, mixed $progressType, string $grade, int $notch, string $startdate = null, string $enddate = null): Employment
    {
        $this->setTenurePeriod($startdate, $enddate);
        $this->position()->associate($position);
        $this->jobRank()->associate($jobRank);
        $this->jobType()->associate($jobType);
        $this->jobStatus()->associate($jobStatus);
        $this->progressType()->associate($progressType);
        $this->grade = $grade;
        $this->notch = $notch;
        return $this;
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

}

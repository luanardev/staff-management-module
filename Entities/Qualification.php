<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\StaffManagement\Concerns\WithFinder;
use Storage;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property mixed $level_id
 * @property string $name
 * @property string $specialization
 * @property string $class
 * @property string $institution
 * @property string $country
 * @property integer $year
 * @property string $attachment
 * @property Staff $staff
 * @property QualificationLevel $qualificationLevel
 */
class Qualification extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_qualifications';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'name', 'level', 'class', 'specialization', 'institution', 'country', 'year', 'attachment'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

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
    public function qualificationLevel(): BelongsTo
    {
        return $this->belongsTo(QualificationLevel::class, 'level_id');
    }

    /**
     * @return string
     */
    public function levelName(): string
    {
        return $this->qualificationLevel->name;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->qualificationLevel->name;
    }

    /**
     * @param string $rootPath
     * @return string
     */
    public function filePath(string $rootPath): string
    {
        return Storage::path($rootPath . DIRECTORY_SEPARATOR . $this->attachment);
    }

    /**
     * @return string
     */
    public function fileName(): string
    {
        $mime = pathinfo($this->attachment, PATHINFO_EXTENSION);
        return $this->name . '.' . $mime;
    }
}

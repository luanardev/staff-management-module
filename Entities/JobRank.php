<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 * @property mixed $category_id
 * @property JobCategory $jobcategory
 */
class JobRank extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_rank';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'category_id'];

    /**
     * Get ranks by gategory
     *
     * @param mixed $category
     * @return Builder
     */
    public static function getByCategory(mixed $category): mixed
    {
        return static::where('category_id', $category);
    }

    /**
     * @return BelongsTo
     */
    public function jobcategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }
}

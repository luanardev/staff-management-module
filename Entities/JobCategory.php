<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 * @property Collection $ranks
 */
class JobCategory extends Model
{
    use WithFinder, HasUuids;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_category';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function ranks(): HasMany
    {
        return $this->hasMany(JobRank::class, 'category_id');
    }
}

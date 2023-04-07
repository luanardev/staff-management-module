<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 */
class JobStatus extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_status';

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
     * @return mixed
     */
    public static function getQuitingStatus(): mixed
    {
        $statuses = ['Retired', 'Resigned', 'Terminated', 'Dismissed', 'Deceased'];
        return static::whereIn('name', $statuses)->pluck('id')->toArray();
    }

    /**
     * @return mixed
     */
    public static function getResumingStatus(): mixed
    {
        $statuses = ['Serving', 'Probation'];
        return static::whereIn('name', $statuses)->pluck('id')->toArray();
    }

    /**
     * @return mixed
     */
    public static function getAttritionStatuses(): mixed
    {
        $statuses = ['Terminated', 'Resigned', 'Retired', 'Dismissed', 'Deceased'];
        return static::whereIn('name', $statuses);
    }

    /**
     * @return mixed
     */
    public static function Serving(): mixed
    {
        return static::findKey('Serving');
    }

    /**
     * @return mixed
     */
    public static function Probation(): mixed
    {
        return static::findKey('Probation');
    }

    /**
     * @return mixed
     */
    public static function Terminated(): mixed
    {
        return static::findKey('Terminated');
    }

    /**
     * @return mixed
     */
    public static function Retired(): mixed
    {
        return static::findKey('Retired');
    }

    /**
     * @return mixed
     */
    public static function Dismissed(): mixed
    {
        return static::findKey('Dismissed');
    }

    /**
     * @return mixed
     */
    public static function Deceased(): mixed
    {
        return static::findKey('Deceased');
    }

    /**
     * @return mixed
     */
    public static function Resigned(): mixed
    {
        return static::findKey('Resigned');
    }

}

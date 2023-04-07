<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 */
class JobType extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_job_type';

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
    public static function Permanent(): mixed
    {
        return static::findKey('Permanent');
    }

    /**
     * @return mixed
     */
    public static function Contract(): mixed
    {
        return static::findKey('Contract');
    }

    /**
     * @return boolean
     */
    public function isPermanent(): bool
    {
        return $this->isNamed('Permanent');
    }

    /**
     * @return boolean
     */
    public function isContract(): bool
    {
        return $this->isNamed('Contract');
    }


}

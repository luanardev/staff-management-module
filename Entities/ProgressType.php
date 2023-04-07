<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 * @property string $description
 */
class ProgressType extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_progress_type';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * @return mixed
     */
    public static function Permanent(): mixed
    {
        return static::findByName('Permanent');
    }

    /**
     * @return mixed
     */
    public static function Contract(): mixed
    {
        return static::findByName('Contract');
    }

    /**
     * @return mixed
     */
    public static function Incremental(): mixed
    {
        return static::findByName('Increment');
    }

    /**
     * @return mixed
     */
    public static function Promotion(): mixed
    {
        return static::findByName('Promotion');
    }

    /**
     * @return mixed
     */
    public static function Appointment(): mixed
    {
        return static::findByName('Appointment');
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
    public function isPromotion(): bool
    {
        return $this->isNamed('Promotion');
    }

    /**
     * @return boolean
     */
    public function isIncrement(): bool
    {
        return $this->isNamed('Increment');
    }

    /**
     * @return boolean
     */
    public function isContract(): bool
    {
        return $this->isNamed('Contract');
    }

    /**
     * @return boolean
     */
    public function isHeadship(): bool
    {
        return $this->isNamed('Headship');
    }

    /**
     * @return boolean
     */
    public function isDeanship(): bool
    {
        return $this->isNamed('Deanship');
    }

    /**
     * @return boolean
     */
    public function isTemporary(): bool
    {
        return $this->isNamed('Temporary');
    }

}

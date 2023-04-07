<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Lumis\StaffManagement\Concerns\WithFinder;

/**
 * @property mixed $id
 * @property string $name
 */
class QualificationLevel extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_qualification_level';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['name'];


    /**
     * @return string[]
     */
    public static function classList(): array
    {
        return [
            'First Class',
            'Second Upper Class',
            'Second Lower Class',
            'Distinction',
            'Merit',
            'Strong Credit',
            'Credit',
            'Strong Pass',
            'Pass'
        ];
    }

}

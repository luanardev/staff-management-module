<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $date_of_birth
 * @property string $gender
 * @property string $relation
 * @property Staff $staff
 */
class Dependant extends Model
{
    use HasUuids;

    const AGE = 21;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_dependants';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'title', 'firstname', 'lastname', 'date_of_birth', 'gender', 'relation'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Concatenate firstname and lastname
     * @return string
     */
    public function name(): string
    {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Concatenate title, firstname and lastname
     * @return string
     */
    public function fullname(): string
    {
        return $this->title . " " . $this->firstname . " " . $this->lastname;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function age(): string
    {
        return Carbon::createFromDate($this->date_of_birth)
            ->diff(Carbon::now())->format('%y Years');
    }

    /**
     * Get age
     *
     * @return bool
     */
    public function isEligible(): bool
    {
        $relations = ['Biological Child', 'Adopted Child'];
        $age = Carbon::createFromDate($this->date_of_birth)->diff(Carbon::now())->y;

        if (in_array($this->relation, $relations) && $age < self::AGE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Date of Birth
     *
     * @return string|null
     */
    public function dateOfBirth(): ?string
    {
        if ((isset($this->date_of_birth))) {
            return $this->date_of_birth->format('d-M-Y');
        } else {
            return null;
        }
    }

}

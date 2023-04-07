<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property string $position
 * @property string $organization
 * @property string $contact_email
 * @property string $contact_address
 * @property string $contact_number
 * @property string $start_date
 * @property string $end_date
 * @property string $responsibilities
 * @property Staff $staff
 */
class Experience extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_experience';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = [
        'staff_id', 'position', 'organization', 'contact_email', 'contact_address', 'contact_number', 'start_date', 'end_date', 'responsibilities'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d'
    ];

    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Joining date
     *
     * @return string|null
     */
    public function startDate(): ?string
    {
        if ((isset($this->start_date))) {
            return $this->start_date->format('d-M-Y');
        } else {
            return null;
        }
    }

    /**
     * Exit date
     *
     * @return string|null
     */
    public function endDate(): ?string
    {
        if ((isset($this->end_date))) {
            return $this->end_date->format('d-M-Y');
        } else {
            return null;
        }
    }

    /**
     * Get  period
     */
    public function period(): ?string
    {
        return isset($this->start_date) && isset($this->end_date) ?
            Carbon::createFromDate($this->start_date)->diff($this->end_date)->format('%y Years, %m Months') : null;
    }
}

<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $relation
 * @property string $occupation
 * @property string $organization
 * @property string $contact_email
 * @property string $contact_address
 * @property string $contact_number
 * @property Staff $staff
 * */
class Kinsman extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_kinsman';

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
        'staff_id', 'title', 'firstname', 'lastname', 'relation', 'occupation',
        'organization', 'contact_email', 'contact_address', 'contact_number',
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

}

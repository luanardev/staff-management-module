<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referee extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_referees';

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
        'staff_id', 'title', 'firstname', 'lastname', 'relation', 'organization',
        'contact_email', 'contact_address', 'contact_number'
    ];

    /**
     * @return BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * Concatenate firstname and lastname
     * @return string
     */
    public function name()
    {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Concatenate title, firstname and lastname
     * @return string
     */
    public function fullname()
    {
        return $this->title . " " . $this->firstname . " " . $this->lastname;
    }


}

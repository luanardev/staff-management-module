<?php

namespace Lumis\StaffManagement\Entities;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Lumis\StaffManagement\Concerns\HasEmployment;
use Lumis\StaffManagement\Concerns\HasProgress;
use Lumis\StaffManagement\Concerns\WithDeanship;
use Lumis\StaffManagement\Concerns\WithEmailNotification;
use Lumis\StaffManagement\Concerns\WithEmployeeNumber;
use Lumis\StaffManagement\Concerns\WithHeadship;
use Lumis\StaffManagement\Concerns\WithManagership;
use Lumis\StaffManagement\Concerns\WithOfficialEmail;
use Lumis\StaffManagement\Concerns\WithQuietUpdate;
use Lumis\StaffManagement\Concerns\WithStaffHelper;
use Lumis\StaffManagement\Concerns\WithSupervision;
use Lumis\StaffManagement\Concerns\WithUserAccount;
use Lumis\Organization\Concerns\CampusPicker;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


/**
 * @property mixed $id
 * @property integer $employee_number
 * @property string $national_id
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $maidenname
 * @property string $date_of_birth
 * @property string $gender
 * @property string $marital_status
 * @property string $official_email
 * @property string $personal_email
 * @property string $contact_address
 * @property string $mobile_contact
 * @property string $home_contact
 * @property string $nationality
 * @property string $home_country
 * @property string $home_village
 * @property string $home_authority
 * @property string $home_district
 * @property string $status
 * @property string $avatar
 * @property string $signature
 * @property Employment $employment
 * @property Spouse $spouse
 * @property Kinsman $kinsman
 * @property Collection $awards
 * @property Collection $dependants
 * @property Collection $qualifications
 * @property Collection $experience
 * @property Collection $referees
 * @property Collection $documents
 */
class Staff extends Model
{
    use HasUuids,
        WithSupervision,
        WithStaffHelper,
        WithEmailNotification,
        WithQuietUpdate,
        WithOfficialEmail,
        WithEmployeeNumber,
        WithUserAccount,
        HasEmployment,
        HasProgress,
        CampusPicker,
        Notifiable,
        Loggable;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_members';

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
        'employee_number', 'national_id', 'title', 'firstname', 'lastname', 'middlename', 'maidenname', 'date_of_birth', 'gender', 'marital_status',
        'official_email', 'personal_email', 'contact_address', 'mobile_contact', 'home_contact', 'nationality', 'home_country', 'home_village', 'home_authority', 'home_district',
        'avatar', 'signature', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * Search Scope for Laravel Livewire DataTable
     * @return Builder
     * @var string $term
     */
    public static function search(string $term): Builder
    {
        return static::where('employee_number', 'like', "%{$term}%")
            ->orwhere('national_id', 'like', "%{$term}%")
            ->orWhere('firstname', 'like', "%{$term}%")
            ->orWhere('lastname', 'like', "%{$term}%");
    }

    /**
     * Get Staff By Authenticated User Campus
     * @return Builder
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getByCampus(): Builder
    {
        $campus = static::getUserCampus();
        if (empty($campus)) {
            return static::query();
        } else {
            return static::where('campus_id', $campus->id);
        }
    }

    /**
     * Find Staff by email
     *
     * @param string $email
     * @return self|null
     */
    public static function findByEmail(string $email): ?Staff
    {
        return static::where('official_email', $email)
            ->orWhere('personal_email', $email)
            ->first();

    }

    /**
     * @return HasOne
     */
    public function employment(): HasOne
    {
        return $this->hasOne(Employment::class, 'staff_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function spouse(): HasOne
    {
        return $this->hasOne(Spouse::class, 'staff_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function kinsman(): HasOne
    {
        return $this->hasOne(Kinsman::class, 'staff_id')->withDefault();
    }

    /**
     * @return HasMany
     */
    public function experience(): HasMany
    {
        return $this->hasMany(Experience::class, 'staff_id');
    }

    /**
     * @return HasMany
     */
    public function referees(): HasMany
    {
        return $this->hasMany(Referee::class, 'staff_id');
    }

    /**
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'staff_id');
    }

    /**
     * Check whether staff has spouse
     *
     * @return boolean
     */
    public function hasSpouse(): bool
    {
        return !is_null($this->spouse->getKey());
    }

    /**
     * Check whether staff has spouse
     *
     * @return boolean
     */
    public function hasKinsman(): bool
    {
        return !is_null($this->kinsman->getKey());
    }

    /**
     * Check whether staff has employment
     *
     * @return boolean
     */
    public function hasEmployment(): bool
    {
        return !is_null($this->employment->getKey());
    }

    /**
     *
     * @return boolean
     */
    public function hasDependants(): bool
    {
        return (bool)$this->dependants()->count();
    }

    /**
     * @return HasMany
     */
    public function dependants(): HasMany
    {
        return $this->hasMany(Dependant::class, 'staff_id');
    }

    /**
     *
     * @return boolean
     */
    public function hasQualifications(): bool
    {
        return (bool)$this->qualifications()->count();
    }

    /**
     * @return HasMany
     */
    public function qualifications(): HasMany
    {
        return $this->hasMany(Qualification::class, 'staff_id');
    }

    /**
     *
     * @return boolean
     */
    public function hasAwards(): bool
    {
        return (bool)$this->awards()->count();
    }

    /**
     * @return HasMany
     */
    public function awards(): HasMany
    {
        return $this->hasMany(Award::class, 'staff_id');
    }

    /**
     * Activate staff
     */
    public function activate()
    {
        $this->setAttribute('status', 'Active');
        $this->saveQuietly();
    }

    /**
     * Deactivate staff
     */
    public function deactivate()
    {
        $this->setAttribute('status', 'Inactive');
        $this->saveQuietly();
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @var Builder $query
     * @var string $term
     * @return Builder
     */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(
            fn($query) => $query->where('id', 'like', "%{$term}%")
                ->orwhere('national_id', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%")
        );
    }

}

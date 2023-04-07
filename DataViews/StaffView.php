<?php

namespace Lumis\StaffManagement\DataViews;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Lumis\StaffManagement\Concerns\HasEmployment;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\Organization\Concerns\CampusPicker;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class StaffView extends Model
{
    use CampusPicker, HasEmployment;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_record_view';

    /**
     * @return Builder
     */
    public static function data(): Builder
    {
        return static::whereIn('status', ['Serving', 'Probation']);
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @return Builder
     *
     * @var string $term
     */
    public static function search(string $term): Builder
    {
        return static::where('employee_number', 'like', "%{$term}%")
            ->orWhere('firstname', 'like', "%{$term}%")
            ->orWhere('lastname', 'like', "%{$term}%")
            ->orWhere('fullname', 'like', "%{$term}%");
    }

    /**
     *
     * @return Builder
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @var string $term
     */
    public static function searchByCampus(string $term): Builder
    {
        return static::getByCampus()
            ->where('employee_number', 'like', "%{$term}%")
            ->orWhere('firstname', 'like', "%{$term}%")
            ->orWhere('lastname', 'like', "%{$term}%")
            ->orWhere('fullname', 'like', "%{$term}%");
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
            return static::findByCampus($campus->name);
        }
    }

    /**
     * Get Staff By Campus Name
     * @param string $name
     * @return Builder
     */
    public static function findByCampus(string $name): Builder
    {
        return static::where('campus', $name);
    }

    /**
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * @return HasOne
     */
    public function employment(): HasOne
    {
        return $this->hasOne(Employment::class, 'staff_id')->withDefault();
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
            fn($query) => $query->where('employee_number', 'like', "%{$term}%")
                ->orWhere('firstname', 'like', "%{$term}%")
                ->orWhere('lastname', 'like', "%{$term}%")
                ->orWhere('fullname', 'like', "%{$term}%")
        );
    }


}

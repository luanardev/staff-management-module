<?php

namespace Lumis\StaffManagement\DataViews;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lumis\Organization\Concerns\CampusPicker;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HeadshipView extends Model
{
    use CampusPicker;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_supervisor_department_view';

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
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * Search Scope for Laravel Livewire DataTable
     * @return Builder
     * @var string $term
     * @var Builder $query
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

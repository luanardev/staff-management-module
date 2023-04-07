<?php

namespace Lumis\StaffManagement\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait WithFinder
{

    /**
     * Find record identifier
     * @param string $name
     * @return mixed
     */
    public static function findKey(string $name): mixed
    {
        $record = static::findByName($name);
        if (!empty($record)) {
            return $record->getKey();
        } else {
            return null;
        }
    }

    /**
     * Find record by name
     * @param string $name
     * @return mixed
     */
    public static function findByName(string $name): mixed
    {
        $record = static::where('name', $name)->first();
        if (empty($record)) {
            return null;
        }
        return $record;
    }

    /**
     * Check whether record exists already
     *
     * @param string $name
     * @return boolean
     */
    public static function recordExists(string $name): bool
    {
        $record = static::findByName($name);
        return !empty($record);

    }

    /**
     * Check name
     *
     * @param string $name
     * @return boolean
     */
    public function isNamed(string $name): bool
    {
        return strtolower($this->name) == strtolower($name);
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
            fn($query) => $query->where('name', 'like', "%{$term}%")
        );
    }

}

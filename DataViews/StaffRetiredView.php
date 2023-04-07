<?php

namespace Lumis\StaffManagement\DataViews;

use Illuminate\Database\Eloquent\Builder;

class StaffRetiredView extends StaffView
{
    /**
     * Search Scope for Laravel Livewire DataTable
     * @return Builder
     * @var string $term
     */
    public static function search(string $term): Builder
    {
        return static::data()
            ->where('employee_number', 'like', "%{$term}%")
            ->orWhere('firstname', 'like', "%{$term}%")
            ->orWhere('lastname', 'like', "%{$term}%")
            ->orWhere('fullname', 'like', "%{$term}%");
    }

    /**
     * @return Builder
     */
    public static function data(): Builder
    {
        return static::where('type', 'Permanent')
            ->where('status', 'Retired');
    }

}

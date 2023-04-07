<?php

namespace Lumis\StaffManagement\DataViews;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ContractExpiringView extends StaffView
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
        $year = Carbon::now()->year;

        return static::where('type', 'Contract')
            ->where('status', 'Serving')
            ->whereYear('end_date', $year);
    }

}

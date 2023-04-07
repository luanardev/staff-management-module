<?php

namespace Lumis\StaffManagement\Reports;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class StaffReport extends ReportBuilder
{

    public function query(): Builder
    {
        $query = DB::table('app_employees_staff_view')->select("*");

        foreach ($this->columns() as $column) {
            $query->when($this->filter($column),
                fn($query, $value) => $query->where($column, $value)
            );
        }
        return $query;
    }

    public function columns(): array
    {
        return [
            'id',
            'title',
            'fullname',
            'gender',
            'position',
            'type',
            'category',
            'status',
            'campus',
            'department',
            'section'
        ];
    }

}

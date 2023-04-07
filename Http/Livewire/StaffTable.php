<?php

namespace Lumis\StaffManagement\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\DataViews\StaffView;
use Lumis\StaffManagement\Entities\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StaffTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('employee_number');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setPaginationEnabled();
        $this->setBulkActionsDisabled();
        $this->setColumnSelectDisabled();

        $this->setTableRowUrl(function($row) {
            $staff = Staff::getByNumber($row->employee_number);
            return route('staff.show', $staff);
        });

    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'employee_number'),
            Column::make('Title'),
            Column::make('Fullname'),
            Column::make('Position'),
            Column::make('Type'),
            Column::make('Section'),
            Column::make('Department'),
            Column::make('Campus'),
        ];
    }

    public function builder(): Builder
    {
        return StaffView::getByCampus()
            ->when($this->getSearch(),
                fn(Builder $query, $term) => $query->search($term)
            );
    }

    protected function getListeners(): array
    {
        return[
            'refresh' => '$refresh'
        ];
    }

}

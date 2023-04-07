<?php

namespace Lumis\StaffManagement\Http\Livewire\Attrition;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\DataViews\AttritionView;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class AttritionTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('employee_number');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setPaginationEnabled();
        $this->setColumnSelectDisabled();
        $this->setBulkActionsDisabled();

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
            Column::make('Status'),
            Column::make('Department'),
            Column::make('Section'),
            Column::make('Campus'),

        ];
    }

    public function builder(): Builder
    {
        return AttritionView::data()
            ->when($this->getSearch(),
                fn(Builder $query, $term) => $query->search($term)
            );
    }

    public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

}

<?php

namespace Lumis\StaffManagement\Http\Livewire\Confirmation;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\DataViews\StaffProbationView;
use Lumis\StaffManagement\Entities\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProbationTable extends DataTableComponent
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
            return route('confirmation.create', $staff);
        });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'employee_number'),
            Column::make('Title'),
            Column::make('Fullname'),
            Column::make('Position'),
            Column::make('Section'),
            Column::make('Department'),
            Column::make('Campus')
        ];
    }

    public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

    public function builder(): Builder
    {
        return StaffProbationView::data()
            ->when($this->getSearch(),
                fn(Builder $query, $term) => $query->search($term)
            );
    }

}

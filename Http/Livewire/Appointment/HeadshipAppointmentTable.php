<?php

namespace Lumis\StaffManagement\Http\Livewire\Appointment;

use Illuminate\Database\Eloquent\Builder;
use Luanardev\LivewireAlert\WithLivewireAlert;
use Lumis\StaffManagement\DataViews\HeadshipView;
use Lumis\StaffManagement\Entities\Headship;
use Lumis\StaffManagement\Entities\Staff;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class HeadshipAppointmentTable extends DataTableComponent
{
    use WithLivewireAlert;

    public function configure(): void
    {
        $this->setPrimaryKey('employee_number');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setPaginationEnabled();
        $this->setBulkActionsEnabled();
        $this->setColumnSelectDisabled();

        $this->setBulkActions([
            'viewAction' => 'View',
            'deleteAction' => 'Delete',
        ]);

        $this->setTableRowUrl(function($row) {
            $staff = Staff::getByNumber($row->employee_number);
            return route('staff.show', $staff);
        });
    }

    public function deleteAction()
    {
        if ($this->getSelectedCount() > 0) {
            foreach ($this->getSelected() as $key) {
                $staff = Staff::getByNumber($key);
                Headship::getStaff($staff)->delete();
            }
            $this->toastr('Operation successful');
            $this->emit('refresh');
        }
    }

    public function viewAction()
    {
        if ($this->getSelectedCount() > 0) {
            $key = collect($this->getSelected())->first();
            $staff = Staff::getByNumber($key);
            $this->redirectRoute('staff.show', $staff);
        }
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'employee_number'),
            Column::make('Title'),
            Column::make('Fullname'),
            Column::make('Position'),
            Column::make('Department'),
            Column::make('Campus')
        ];
    }

    public function builder(): Builder
    {
        return HeadshipView::query()
            ->when($this->getSearch(),
                fn(Builder $query, $term) => $query->search($term)
            );
    }

    public function getListeners(): array
    {
        return [
            'refresh' => '$refresh',
        ];
    }


}

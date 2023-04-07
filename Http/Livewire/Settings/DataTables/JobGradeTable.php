<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\Entities\JobGrade;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;


class JobGradeTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPageName('page');
        $this->setPerPageAccepted([10, 25, 50, 100]);
        $this->setSearchEnabled();
        $this->setPaginationEnabled();
        $this->setBulkActionsEnabled();
        $this->setColumnSelectDisabled();

        $this->setBulkActions([
            'editAction' => 'Edit',
            'deleteAction' => 'Delete',
        ]);
    }

    public function editAction()
    {
        if ($this->getSelectedCount() > 0) {
            $key = collect($this->getSelected())->first();
            return $this->emit('edit-grade', $key);
        }
    }

    public function deleteAction()
    {
        if ($this->getSelectedCount() > 0) {
            return $this->emit('delete-grade', $this->getSelected());
        }
    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('Leave Days', 'leave_days'),
            Column::make('ID', 'id'),
        ];
    }

    public function builder():Builder
    {
        return JobGrade::query()
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

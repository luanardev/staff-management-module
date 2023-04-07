<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\Entities\JobRank;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;


class JobRankTable extends DataTableComponent
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
            return $this->emit('edit-rank', $key);
        }
    }

    public function deleteAction()
    {
        if ($this->getSelectedCount() > 0) {
            return $this->emit('delete-rank', $this->getSelected());
        }
    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('Category', 'jobCategory.name'),
            Column::make('ID', 'id'),
        ];
    }

    public function builder():Builder
    {
        return JobRank::query()
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

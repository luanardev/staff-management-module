<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings\DataTables;

use Lumis\StaffManagement\Entities\DocumentType;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;


class DocumentTypeTable extends DataTableComponent
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
            return $this->emit('edit-document-type', $key);
        }
    }

    public function deleteAction()
    {
        if ($this->getSelectedCount() > 0) {
            return $this->emit('delete-document-type', $this->getSelected());
        }
    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('ID', 'id'),
        ];
    }

    public function builder(): Builder
    {
        return DocumentType::query()
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

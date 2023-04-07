<?php

namespace Lumis\StaffManagement\Http\Livewire\Contract;

use Illuminate\Database\Eloquent\Builder;
use Lumis\StaffManagement\DataViews\StaffRetiredView;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StaffRetiredTable extends DataTableComponent
{

    public array $perPageAccepted = [10, 20, 50, 100, 200, 500];

    public bool $columnSelect = true;

    public function configure(): void
    {

    }

    public function getTableRowUrl($row): string
    {
        return route('contract.create', $row);
    }

    public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'employee_number')->excludeFromSelectable()->sortable(),
            Column::make('Fullname')->excludeFromSelectable()->sortable(),
            Column::make('Position')->excludeFromSelectable(),
            Column::make('Type')->excludeFromSelectable(),
            Column::make('Section'),
            Column::make('Department'),
            Column::make('Campus'),
        ];
    }

    public function query(): Builder
    {
        return StaffRetiredView::data()
            ->when($this->getFilter('search'),
                fn($query, $term) => $query->search($term)
            );
    }

}

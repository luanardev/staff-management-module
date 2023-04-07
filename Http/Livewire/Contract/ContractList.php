<?php

namespace Lumis\StaffManagement\Http\Livewire\Contract;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\ContractExpiringView;
use Lumis\StaffManagement\Entities\Employment;

class ContractList extends LivewireUI
{
    public $contractList;

    public $searchTerm;

    public $route;

    public function mount($route = null)
    {
        $this->query();
    }

    public function query()
    {
        $this->contractList = ContractExpiringView::data()->get();
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->contractList = ContractExpiringView::search($this->searchTerm)->get();
    }

    public function terminate($employeeId)
    {
        $employment = Employment::find($employeeId);
        if (!$employment->isTerminated()) {
            $employment->terminateContract();
            $this->emitRefresh()->toastr('Contract Terminated successful');
        } else {
            $this->emitRefresh()->toastrError('Contract already terminated');
        }
    }

    public function render()
    {
        return view('staffmanagement::livewire.contract.contract-list');
    }


}

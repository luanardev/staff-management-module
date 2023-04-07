<?php

namespace Lumis\StaffManagement\Http\Livewire\Reinstatement;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffDismissedView;
use Lumis\StaffManagement\Entities\Employment;

class DismissedList extends LivewireUI
{
    public $dismissedList;

    public $searchTerm;

    public $route;

    public function mount($route = null)
    {
        $this->query();
    }

    public function query()
    {
        $this->dismissedList = StaffDismissedView::data()->get();
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->dismissedList = StaffDismissedView::search($this->searchTerm)->get();
    }

    public function reinstate($employeeId)
    {
        $employment = Employment::find($employeeId);
        if ($employment->isNotServing()) {
            $employment->reinstateEmployment();
            $this->emitRefresh()->toastr('Reinstatement successful');
        } else {
            $this->emitRefresh()->toastrError('Staff already reinstated');
        }
    }

    public function render()
    {
        return view('staffmanagement::livewire.reinstatement.dismissed-list');
    }


}

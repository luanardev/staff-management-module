<?php

namespace Lumis\StaffManagement\Http\Livewire\Confirmation;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffProbationView;

class ProbationList extends LivewireUI
{
    public $probationList;

    public $searchTerm;

    public $route;

    public function mount($route = null)
    {
        $this->query();
    }

    public function query()
    {
        $this->probationList = StaffProbationView::data()->get();
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->probationList = StaffProbationView::search($this->searchTerm)->get();
    }

    public function render()
    {
        return view('staffmanagement::livewire.confirmation.probation-list');
    }


}

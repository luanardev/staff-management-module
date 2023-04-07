<?php

namespace Lumis\StaffManagement\Http\Livewire\Contract;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffRetiredView;

class SearchStaffRetired extends LivewireUI
{
    public $searchTerm;
    public $searchResults;
    public $route;

    public function mount($route)
    {
        $this->route = $route;
    }

    public function render()
    {
        return view("staffmanagement::livewire.contract.search-retired-staff");
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->searchResults = StaffRetiredView::search($this->searchTerm)->get();
    }


}

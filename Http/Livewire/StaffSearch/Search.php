<?php

namespace Lumis\StaffManagement\Http\Livewire\StaffSearch;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffSearchView;

class Search extends LivewireUI
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
        return view("staffmanagement::livewire.staffsearch.search");
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->searchResults = StaffSearchView::search($this->searchTerm)->get();
    }


}

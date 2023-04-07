<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Exception;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffView;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class SupervisorPage extends LivewireUI
{
    use WithEnums;

    public Staff $supervisor;
    public Staff $staff;
    public $searchTerm;
    public $searchResults;

    public function mount(Staff $staff)
    {
        parent::mount($staff);
        if (!empty($staff->supervisor)) {
            $this->supervisor = $staff->supervisor;
        } else {
            $this->supervisor = new Staff();
        }
    }

    public function create()
    {
        $this->createMode();
    }

    public function show()
    {
        $this->reset(['searchTerm', 'searchResults']);
        $this->browseMode();
    }

    public function search()
    {
        if (empty($this->searchTerm)) {
            return false;
        }
        $this->searchResults = StaffView::searchByCampus($this->searchTerm)->get();
    }

    public function assign(Staff $supervisor)
    {
        try {
            if ($supervisor->is($this->staff)) {
                return $this->toastrError('Invalid Supervisor');
            }
            $this->supervisor = $supervisor;
            $this->staff->setSupervisorOnce($supervisor);
            $this->reset(['searchTerm', 'searchResults']);
            $this->browseMode()->toastr('Supervisor assigned');
        } catch (Exception $ex) {
            $this->toastrError('Supervisor already assigned');
        }

    }

    public function unassign(Staff $supervisor)
    {
        $this->staff->removeSupervisor($supervisor);
        $this->browseMode()->toastr('Supervisor removed');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.supervisor.index');
    }


}

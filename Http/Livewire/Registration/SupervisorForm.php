<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Exception;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\DataViews\StaffView;
use Lumis\StaffManagement\Entities\Staff;

class SupervisorForm extends LivewireUI
{
    public mixed $searchTerm;
    public mixed $searchResults;
    public mixed $supervisor;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->nextRoute = null;
        $this->recovery();

    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->supervisor = $staff->supervisor;

        } else {
            $this->supervisor = new Staff;
        }
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
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
        if (!session()->exists('staff')) {
            $this->toastrError('Cannot assign supervisor');
            return false;
        }
        $staff = Staff::find(session()->get('staff'));
        try {
            $this->supervisor = $supervisor;
            $staff->setSupervisor($supervisor);
            $this->reset(['searchTerm', 'searchResults']);

            $this->toastr('Supervisor saved');

        } catch (Exception $ex) {
            $this->toastrError($ex->getMessage());
        }

    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.supervision.index');
    }

}

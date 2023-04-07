<?php

namespace Lumis\StaffManagement\Http\Livewire\Appointment;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Deanship;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Faculty;

class DeanshipAppointment extends LivewireUI
{
    public Staff $staff;
    public $faculty;
    public $campus;
    public $position;
    public $startdate;
    public $enddate;


    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->campus = $staff->employment->campus_id;
    }

    public function save()
    {
        $deanship = new Deanship;

        if ($deanship->isDean($this->staff) || $deanship->isDeputy($this->staff)) {
            return $this->toastrError('Staff already appointed');
        } elseif ($deanship->isAssigned($this->faculty, $this->campus, $this->position)) {
            return $this->toastrError('Deanship already assigned');
        } else {
            $deanship->add($this->staff, $this->faculty, $this->campus, $this->position, $this->startdate, $this->enddate);
            $this->toastr('Operation successful');
            return $this->redirect(route('deanship.index'));
        }

    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.appointment.deanship.create');
    }

    public function viewData()
    {
        $this->with('faculty', Faculty::pluck('id', 'name')->flip()->toArray());
        $this->with('campus', Campus::pluck('id', 'name')->flip()->toArray());
        $this->with('position', Deanship::positions());
    }
}

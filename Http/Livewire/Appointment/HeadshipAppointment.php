<?php

namespace Lumis\StaffManagement\Http\Livewire\Appointment;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Headship;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;

class HeadshipAppointment extends LivewireUI
{
    public Staff $staff;
    public $department;
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
        $headship = new Headship;

        if ($headship->isHead($this->staff) || $headship->isDeputy($this->staff)) {
            return $this->toastrError('Staff already appointed');
        } elseif ($headship->isAssigned($this->department, $this->campus, $this->position)) {
            return $this->toastrError('Headship already assigned');
        } else {
            $headship->add($this->staff, $this->department, $this->campus, $this->position, $this->startdate, $this->enddate);
            $this->toastr('Operation successful');
            return $this->redirect(route('headship.index'));
        }

    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.appointment.headship.create');
    }

    public function viewData()
    {
        $this->with('department', Department::pluck('id', 'name')->flip()->toArray());
        $this->with('campus', Campus::pluck('id', 'name')->flip()->toArray());
        $this->with('position', Headship::positions());
    }
}

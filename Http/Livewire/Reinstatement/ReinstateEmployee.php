<?php

namespace Lumis\StaffManagement\Http\Livewire\Reinstatement;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\Staff;

class ReinstateEmployee extends LivewireUI
{
    public $confirmationDate;
    public $confirmationComment;
    public Staff $staff;
    public Employment $employment;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->employment = $staff->employment;

    }

    public function render()
    {
        return view('staffmanagement::livewire.reinstatement.reinstate-employee');
    }

    public function reinstate()
    {
        if ($this->employment->isNotServing()) {
            $this->employment->reinstateEmployment();
            $this->emitRefresh()->toastr('Reinstatement successful');
        } else {
            $this->emitRefresh()->toastrError('Staff already reinstated');
        }
        return $this->redirect(route('reinstatement.index'));
    }

}

<?php

namespace Lumis\StaffManagement\Http\Livewire\Attrition;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\Staff;

class Attrition extends LivewireUI
{
    public Staff $staff;
    public Employment $employment;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->employment = $staff->employment;

    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.attrition.attrition');
    }

    public function viewData()
    {
        $this->with('status', JobStatus::getAttritionStatuses()->pluck('id', 'name')->flip()->toArray());
    }

    public function save()
    {
        $this->validate();
        $this->employment->save();
        $this->emitRefresh()->toastr('Attrition successful');

        return $this->redirect(route('attrition.index'));

    }

    public function rules()
    {
        return [
            'employment.job_status_id' => 'required',
        ];
    }


}

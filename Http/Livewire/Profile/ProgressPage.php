<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class ProgressPage extends LivewireUI
{
    use WithEnums;

    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function delete($id)
    {
        Progress::destroy($id);
        $this->emitRefresh()->toastr('Career Progress deleted');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.progress.index');
    }


}

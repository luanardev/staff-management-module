<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class Avatar extends LivewireUI
{
    use WithFileUploads, WithEnums;

    public Staff $staff;
    public mixed $photo;

    public function __construct()
    {
        parent::__construct();
        $this->photo = null;
    }

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function show()
    {
        $this->browseMode();
    }

    public function create()
    {
        $this->createMode();
    }

    public function save()
    {
        if (empty($this->photo)) {
            return;
        }
        $this->validate([
            'photo' => 'required|image|max:10240',
        ]);
        $staffNo = $this->staff->id;
        $path = $this->photo->storePublicly("staffmanagement/{$staffNo}/avatar", 'public');
        $this->staff->avatar = $path;
        $this->staff->save();
        $this->browseMode()->emitRefresh()->toastr('Photo saved');
    }

    public function render()
    {
        return view("staffmanagement::livewire.profile.avatar.index");
    }


}

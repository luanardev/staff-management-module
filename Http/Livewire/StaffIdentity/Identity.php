<?php

namespace Lumis\StaffManagement\Http\Livewire\StaffIdentity;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Staff;
use Storage;

class Identity extends LivewireUI
{
    use WithFileUploads;

    public Staff $staff;
    public $avatar;
    public $signature;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        return view("staffmanagement::livewire.staffidentity.identity");
    }

    public function saveAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:10240',
        ]);

        $oldAvatar = $this->staff->avatar;
        $staffNo = $this->staff->id;
        $avatar = $this->avatar->storePublicly("staffmanagement/{$staffNo}/avatar", 'public');
        $this->staff->avatar = $avatar;
        if ($this->staff->saveQuietly()) {
            if (Storage::exists("public/" . $oldAvatar)) {
                Storage::delete("public/" . $oldAvatar);
            }
            $this->browseMode()->emitRefresh()->toastr('Photo saved');
        }
    }

    public function saveSignature()
    {
        $this->validate([
            'signature' => 'image|max:10240',
        ]);

        $oldSignature = $this->staff->signature;
        $staffNo = $this->staff->id;
        $signature = $this->signature->storePublicly("staffmanagement/{$staffNo}/signature", 'public');
        $this->staff->signature = $signature;
        if ($this->staff->saveQuietly()) {
            if (Storage::exists("public/" . $oldSignature)) {
                Storage::delete("public/" . $oldSignature);
            }
            $this->browseMode()->emitRefresh()->toastr('Signature saved');
        }
    }


}

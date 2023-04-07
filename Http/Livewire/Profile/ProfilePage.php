<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class ProfilePage extends LivewireUI
{
    use WithEnums;

    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function edit($object = null)
    {
        $this->editMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('gender', $this->gender());
        $this->with('maritalStatus', $this->maritalStatus());
        $this->with('district', $this->district());
        $this->with('country', $this->country());
    }

    public function show()
    {
        $this->browseMode();
    }

    public function save()
    {
        $this->validate();
        $this->staff->nationality = $this->staff->home_country;
        $this->staff->save();
        $this->browseMode()->emitRefresh()->toastr('Profile updated');
    }

    public function render()
    {
        return view("staffmanagement::livewire.profile.profile.index");
    }

    public function rules()
    {
        return [
            'staff.national_id' => 'nullable|string',
            'staff.title' => 'required|string',
            'staff.firstname' => 'required|string',
            'staff.lastname' => 'required|string',
            'staff.middlename' => 'nullable|string',
            'staff.maidenname' => 'nullable|string',
            'staff.marital_status' => 'required|string',
            'staff.date_of_birth' => 'required|date',
            'staff.gender' => 'required|string',
            'staff.contact_address' => 'nullable|string',
            'staff.personal_email' => 'required|email',
            'staff.mobile_contact' => 'required|string',
            'staff.home_contact' => 'nullable|string',
            'staff.home_village' => 'required|string',
            'staff.home_authority' => 'required|string',
            'staff.home_district' => 'required|string',
            'staff.home_country' => 'required|string',
        ];
    }

}

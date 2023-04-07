<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Spouse;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class SpousePage extends LivewireUI
{
    use WithEnums;

    public Spouse $spouse;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->spouse = new Spouse();
    }

    public function create()
    {
        $this->createMode();
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

    public function edit($object = null)
    {
        $this->spouse = $this->staff->spouse;
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete()
    {
        $this->staff->spouse()->delete();
        $this->browseMode()->emitRefresh()->toastr('Spouse deleted');
    }

    public function save()
    {
        $this->validate();
        $this->spouse->staff()->associate($this->staff);
        $this->spouse->save();
        $this->browseMode()->emitRefresh()->toastr('Spouse saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.spouse.index');
    }

    public function rules()
    {
        return [
            'spouse.title' => 'required|string',
            'spouse.national_id' => 'nullable|string',
            'spouse.firstname' => 'required|string',
            'spouse.lastname' => 'required|string',
            'spouse.date_of_birth' => 'date',
            'spouse.gender' => 'required|string',
            'spouse.contact_email' => 'required|email',
            'spouse.contact_number' => 'required|string',
            'spouse.contact_address' => 'required|string',
            'spouse.home_country' => 'required|string',
            'spouse.home_village' => 'required|string',
            'spouse.home_authority' => 'required|string',
            'spouse.home_district' => 'required|string',

        ];

    }

}

<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Kinsman;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class KinsmanPage extends LivewireUI
{
    use WithEnums;
    public Kinsman $kinsman;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->kinsman = new Kinsman();
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('relation', $this->family());
    }

    public function edit($object = null)
    {
        $this->kinsman = $this->staff->kinsman;
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete()
    {
        $this->staff->kinsman()->delete();
        $this->browseMode()->emitRefresh()->toastr('Next of Kin deleted');
    }

    public function save()
    {
        $this->validate();
        $this->kinsman->staff()->associate($this->staff);
        $this->kinsman->save();
        $this->browseMode()->emitRefresh()->toastr('Next of Kin saved');
    }

    public function copySpouse()
    {
        if ($this->staff->hasSpouse()) {
            $this->kinsman->fill($this->staff->spouse->getAttributes());
            if ($this->staff->gender == 'Male') {
                $this->kinsman->relation = 'Wife';
            }
            if ($this->staff->gender == 'Female') {
                $this->kinsman->relation = 'Husband';
            }
            $this->editMode();
            $this->viewData();
        } else {
            $this->toastrError('Spouse record not found');
        }

    }

    public function resetSpouse()
    {
        $this->reset(['kinsman']);
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.kinsman.index');
    }

    public function rules()
    {
        return [
            'kinsman.title' => 'required|string',
            'kinsman.firstname' => 'required|string',
            'kinsman.lastname' => 'required|string',
            'kinsman.relation' => 'required|string',
            'kinsman.occupation' => 'nullable|string',
            'kinsman.organization' => 'nullable|string',
            'kinsman.contact_email' => 'required|email',
            'kinsman.contact_number' => 'required|string',
            'kinsman.contact_address' => 'required|string',

        ];

    }


}

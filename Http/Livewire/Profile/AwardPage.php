<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Award;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class AwardPage extends LivewireUI
{
    use WithEnums;

    public Award $award;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->award = new Award();
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.award.index');
    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('country', $this->country());
    }

    public function edit($object = null)
    {
        $this->award = Award::find($object);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Award::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Award deleted');
    }

    public function save()
    {
        $this->validate();
        $this->award->staff()->associate($this->staff);
        $this->award->save();
        $this->reset(['award']);
        $this->browseMode()->emitRefresh()->toastr('Award saved');
    }

    public function rules()
    {
        return [
            'award.name' => 'required|string',
            'award.institution' => 'required|string',
            'award.country' => 'required|string',
            'award.year' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-award' => 'create',
            'edit-award' => 'edit',
            'delete-award' => 'delete',
        ];
    }


}

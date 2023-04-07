<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Experience;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class ExperiencePage extends LivewireUI
{
    use WithEnums;

    public Experience $experience;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->experience = new Experience();
    }

    public function create()
    {
        $this->createMode();
    }

    public function edit($object = null)
    {
        $this->experience = Experience::find($object);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Experience::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Work experience deleted');
    }

    public function save()
    {
        $this->validate();
        $this->experience->staff()->associate($this->staff);
        $this->experience->save();
        $this->reset(['experience']);
        $this->browseMode()->emitRefresh()->toastr('Work experience saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.experience.index');
    }

    public function rules()
    {
        return [
            'experience.position' => 'required|string',
            'experience.organization' => 'required|string',
            'experience.contact_email' => 'required|email',
            'experience.contact_number' => 'required|string',
            'experience.contact_address' => 'required|string',
            'experience.start_date' => 'required|date',
            'experience.end_date' => 'required|date',
        ];

    }

    public function getListeners()
    {
        return [
            'create-experience' => 'create',
            'edit-experience' => 'edit',
            'delete-experience' => 'delete',
        ];
    }


}

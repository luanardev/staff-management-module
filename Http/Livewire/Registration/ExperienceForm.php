<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Experience;
use Lumis\StaffManagement\Entities\Staff;

class ExperienceForm extends LivewireUI
{
    public Experience $experience;
    public mixed $experiences;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->experiences = collect();
        $this->nextRoute = null;
        $this->recovery();
        $this->experience = new Experience;

    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->experiences = $staff->experience()->latest()->get();
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $this->createMode();
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.experience.index');
    }

    public function edit($id)
    {
        $this->experience = Experience::find($id);
        $this->create();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset(['experience']);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Experience::destroy($id);
        $this->browse();
        $this->toastr('Previous Employment deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->experience->staff()->associate($staff);
        $this->experience->save();
        $this->resetFields();
        $this->toastr('Previous Employment saved');
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


}

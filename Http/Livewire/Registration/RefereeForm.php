<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Referee;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class RefereeForm extends LivewireUI
{
    use WithEnums;

    public Referee $referee;
    public mixed $referees;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->referees = collect();
        $this->nextRoute = null;
        $this->recovery();
        $this->referee = new Referee();
    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->referees = $staff->referees()->latest()->get();
        } else {
            $this->create();
        }

    }

    public function create()
    {
        $this->createMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('title', $this->title());
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.referee.index');
    }

    public function edit($id)
    {
        $this->referee = Referee::find($id);
        $this->create();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset(['referee']);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Referee::destroy($id);
        $this->browse();
        $this->toastr('Referee deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->referee->staff()->associate($staff);
        $this->referee->save();
        $this->resetFields();
        $this->toastr('Referee saved');
    }

    public function rules()
    {
        return [
            'referee.title' => 'required|string',
            'referee.firstname' => 'required|string',
            'referee.lastname' => 'required|string',
            'referee.relation' => 'required|string',
            'referee.organization' => 'required|string',
            'referee.contact_email' => 'required|email',
            'referee.contact_number' => 'required|string',
            'referee.contact_address' => 'required|string',
        ];

    }


}

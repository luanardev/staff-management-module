<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Referee;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class RefereePage extends LivewireUI
{
    use WithEnums;

    public Referee $referee;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->referee = new Referee();
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

    public function edit($object = null)
    {
        $this->referee = Referee::find($object);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Referee::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Reference deleted');
    }

    public function save()
    {
        $this->validate();
        $this->referee->staff()->associate($this->staff);
        $this->referee->save();
        $this->reset(['referee']);
        $this->browseMode()->emitRefresh()->toastr('Reference saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.referee.index');
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

    public function getListeners()
    {
        return [
            'create-referee' => 'create',
            'edit-referee' => 'edit',
            'delete-referee' => 'delete',
        ];
    }


}

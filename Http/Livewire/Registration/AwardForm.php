<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Award;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class AwardForm extends LivewireUI
{
    use WithEnums;

    public Award $award;
    public mixed $awards;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->awards = collect();
        $this->nextRoute = null;
        $this->recovery();
        $this->award = new Award();

    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->awards = $staff->awards()->latest()->get();
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
        $this->with('country', $this->country());
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.award.index');
    }

    public function edit($id)
    {
        $this->award = Award::find($id);
        $this->create();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset(['award']);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Award::destroy($id);
        $this->browse();
        $this->toastr('Award deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->award->staff()->associate($staff);
        $this->award->save();
        $this->resetFields();
        $this->toastr('Academic Award saved');
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


}

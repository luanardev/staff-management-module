<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Dependant;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class DependantForm extends LivewireUI
{
    use WithEnums;

    public Dependant $dependant;
    public mixed $dependants;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->dependants = collect();
        $this->nextRoute = null;
        $this->recovery();
        $this->dependant = new Dependant();

    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->dependants = $staff->dependants()->latest()->get();
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
        $this->with('relation', $this->family());
        $this->with('gender', $this->gender());
        $this->with('title', $this->title());
    }

    protected function family(): array
    {
        return ["Father", "Mother", "Biological Child", "Adopted Child"];
    }

    protected function title(): array
    {
        return ["Mr", "Mrs", "Miss"];
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.dependant.index');
    }

    public function edit($id)
    {
        $this->dependant = Dependant::find($id);
        $this->create();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset(['dependant']);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Dependant::destroy($id);
        $this->browse();
        $this->toastr('Dependant deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();

        if (!$this->dependant->isEligible()) {
            $this->toastr('Dependant is not eligible because of Age');
            return false;
        }

        $staff = Staff::find(session()->get('staff'));
        $this->dependant->staff()->associate($staff);
        $this->dependant->save();
        $this->resetFields();
        $this->toastr('Dependant saved');
    }

    public function rules()
    {
        return [
            'dependant.title' => 'required|string',
            'dependant.firstname' => 'required|string',
            'dependant.lastname' => 'required|string',
            'dependant.gender' => 'required|string',
            'dependant.date_of_birth' => 'required|date',
            'dependant.relation' => 'required|string',
        ];

    }


}

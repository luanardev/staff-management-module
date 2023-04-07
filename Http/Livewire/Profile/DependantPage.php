<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Dependant;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class DependantPage extends LivewireUI
{
    use WithEnums;

    public Dependant $dependant;
    public Staff $staff;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->dependant = new Dependant();
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

    public function edit($object = null)
    {
        $this->dependant = Dependant::find($object);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Dependant::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Dependant deleted');
    }

    public function save()
    {
        $this->validate();

        if (!$this->dependant->isEligible()) {
            $this->toastr('Dependant is not eligible because of Age');
            return false;
        }


        $this->dependant->staff()->associate($this->staff);
        $this->dependant->save();
        $this->reset(['dependant']);
        $this->browseMode()->emitRefresh()->toastr('Dependant saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.dependant.index');
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

    public function getListeners()
    {
        return [
            'create-dependant' => 'create',
            'edit-dependant' => 'edit',
            'delete-dependant' => 'delete'
        ];
    }


}

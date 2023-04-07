<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Kinsman;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class KinsmanForm extends LivewireUI
{
    use WithEnums;

    public Kinsman $kinsman;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->nextRoute = null;
        $this->recovery();
    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->kinsman = $staff->kinsman;
        } else {
            $this->kinsman = new Kinsman();
        }

    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.registration.kinsman.create');
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('relation', $this->family());
    }

    public function copySpouse()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $staff = Staff::find(session()->get('staff'));
        if ($staff->hasSpouse()) {
            $this->kinsman->fill($staff->spouse->getAttributes());
            $this->kinsman->occupation = $staff->getPosition();
        }
    }

    public function resetForm()
    {
        $this->kinsman = new Kinsman();
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->kinsman->staff()->associate($staff);
        $this->kinsman->save();

        return $this->nextForm();
    }

    public function nextForm()
    {
        return $this->redirect(route($this->nextRoute));
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

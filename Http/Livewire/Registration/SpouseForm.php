<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Spouse;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class SpouseForm extends LivewireUI
{
    use WithEnums;

    public Spouse $spouse;
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
            $this->spouse = $staff->spouse;
        } else {
            $this->spouse = new Spouse;
        }
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.registration.spouse.create');
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('gender', $this->gender());
        $this->with('maritalStatus', $this->maritalStatus());
        $this->with('district', $this->district());
        $this->with('country', $this->country());
    }

    public function updated($key, $value)
    {
        if ($key == 'spouse.national_id') {
            $staff = Staff::where('national_id', $value)->first();
            if (!empty($staff)) {
                $this->spouse->fill($staff->getAttributes());
                $this->spouse->contact_email = $staff->personal_email;
                $this->spouse->contact_number = $staff->mobile_contact;
            }
        }
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }
        $this->validate();
        $staff = Staff::find(session()->get('staff'));
        $this->spouse->staff()->associate($staff);
        $this->spouse->save();

        return $this->nextForm();
    }

    public function nextForm()
    {
        return $this->redirect(route($this->nextRoute));
    }

    public function rules()
    {
        return [
            'spouse.national_id' => 'nullable|string',
            'spouse.title' => 'required|string',
            'spouse.firstname' => 'required|string',
            'spouse.lastname' => 'required|string',
            'spouse.date_of_birth' => 'date',
            'spouse.gender' => 'required|string',
            'spouse.contact_email' => 'required|email',
            'spouse.contact_number' => 'required|string',
            'spouse.contact_address' => 'required|string',
            'spouse.home_country' => 'required|string',
            'spouse.home_village' => 'required|string',
            'spouse.home_authority' => 'required|string',
            'spouse.home_district' => 'required|string',

        ];

    }

}

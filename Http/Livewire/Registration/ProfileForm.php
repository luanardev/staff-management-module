<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Spouse;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class ProfileForm extends LivewireUI
{
    use WithEnums;

    public Staff $staff;
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
            $this->staff = Staff::find(session()->get('staff'));
        } else {
            $this->staff = new Staff;

        }
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        $this->viewData();
        return view("staffmanagement::livewire.registration.profile.create");
    }

    public function viewData()
    {
        $this->with('title', $this->title());
        $this->with('gender', $this->gender());
        $this->with('maritalStatus', $this->maritalStatus());
        $this->with('district', $this->district());
        $this->with('country', $this->country());
    }

    public function create()
    {
        if (session()->exists('staff')) {
            session()->forget('staff');
            $this->resetFields();
            $this->alert('Staff added successfully');
            $this->redirect(route('staff.create'));
        } else {
            session()->forget('success');
        }

    }

    public function resetFields()
    {
        $this->reset(['staff']);
    }

    public function updated($key, $value)
    {
        if ($key == 'staff.national_id') {
            $spouse = Spouse::where('national_id', $value)->first();
            if (!empty($spouse)) {
                $this->staff->fill($spouse->getAttributes());
                $this->staff->personal_email = $spouse->contact_email;
                $this->staff->mobile_contact = $spouse->contact_number;
            }
        }
    }

    public function save()
    {
        $this->validate();
        $this->staff->makeIdNumber();
        $this->staff->nationality = $this->staff->home_country;
        $this->staff->save();
        session()->put('staff', $this->staff->id);

        return $this->nextForm();
    }

    public function nextForm()
    {
        return $this->redirect(route($this->nextRoute));
    }

    public function rules()
    {
        return [
            'staff.employee_number' => 'nullable',
            'staff.national_id' => 'nullable',
            'staff.title' => 'required|string',
            'staff.firstname' => 'required|string',
            'staff.lastname' => 'required|string',
            'staff.middlename' => 'nullable|string',
            'staff.maidenname' => 'nullable|string',
            'staff.marital_status' => 'required|string',
            'staff.date_of_birth' => 'required|date',
            'staff.gender' => 'required|string',
            'staff.contact_address' => 'required|string',
            'staff.personal_email' => 'required|email',
            'staff.official_email' => 'nullable|email',
            'staff.mobile_contact' => 'required|string',
            'staff.home_contact' => 'nullable|string',
            'staff.home_village' => 'required|string',
            'staff.home_authority' => 'required|string',
            'staff.home_district' => 'required|string',
            'staff.home_country' => 'required|string'
        ];
    }

    public function getListeners()
    {
        return [
            'create-staff' => 'create'
        ];
    }

}

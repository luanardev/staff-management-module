<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Qualification;
use Lumis\StaffManagement\Entities\QualificationLevel;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class QualificationForm extends LivewireUI
{
    use WithFileUploads;
    use WithEnums;

    public Qualification $qualification;
    public mixed $qualifications;
    public mixed $uploadedFile;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->qualifications = collect();
        $this->uploadedFile = null;
        $this->nextRoute = null;
        $this->recovery();
        $this->qualification = new Qualification;
    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->qualifications = $staff->qualifications()->orderBy('year', 'desc')->get();
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
        $this->with('class', $this->classList());
        $this->with('level', QualificationLevel::pluck('id', 'name')->flip()->toArray());
    }

    protected function classList(): array
    {
        return QualificationLevel::classList();
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view('staffmanagement::livewire.registration.qualification.index');
    }

    public function edit($id)
    {
        $this->qualification = Qualification::find($id);
        $this->create();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset(['qualification', 'uploadedFile']);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Qualification::destroy($id);
        $this->browse();
        $this->toastr('Qualification deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();

        $staff = Staff::find(session()->get('staff'));

        if (isset($this->uploadedFile)) {
            $savedPath = $this->uploadedFile->storePublicly("staffmanagement/{$staff->id}/qualifications", 'public');
            $this->qualification->attachment = $savedPath;
        }

        $this->qualification->staff()->associate($staff);
        $this->qualification->save();
        $this->resetFields();
        $this->toastr('Qualification saved');
    }

    public function rules()
    {
        return [
            'qualification.name' => 'required|string',
            'qualification.level_id' => 'required',
            'qualification.specialization' => 'nullable|string',
            'qualification.class' => 'nullable|string',
            'qualification.institution' => 'required|string',
            'qualification.country' => 'required|string',
            'qualification.year' => 'required|string',
            'uploadedFile' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480'
        ];

    }

}

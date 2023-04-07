<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Qualification;
use Lumis\StaffManagement\Entities\QualificationLevel;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;
use Storage;

class QualificationPage extends LivewireUI
{
    use WithFileUploads, WithEnums;

    public Staff $staff;
    public Qualification $qualification;
    public mixed $uploadedFile;


    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->qualification = new Qualification();
        $this->uploadedFile = null;
    }

    public function create()
    {
        $this->reset(['qualification', 'uploadedFile']);
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

    public function edit($object = null)
    {
        $this->qualification = Qualification::find($object);
        $this->editMode();
        $this->viewData();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Qualification::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Qualification deleted');
    }

    public function download($object)
    {

        $qualification = Qualification::find($object);
        if (empty($qualification->attachment)) {
            return $this->toastrError('Attachment not found');
        } else {
            $filePath = $qualification->filePath('public');
            $fileName = $qualification->fileName();
            return response()->download($filePath, $fileName)->deleteFileAfterSend(false);
        }
    }

    public function save()
    {
        $this->validate();

        $staffNo = $this->staff->id;
        if (isset($this->uploadedFile)) {
            $savedPath = $this->uploadedFile->storePublicly("staffmanagement/{$staffNo}/qualifications", 'public');
            $this->qualification->attachment = $savedPath;
        }

        $this->qualification->staff()->associate($this->staff);

        $this->qualification->save();

        $this->reset(['qualification', 'uploadedFile']);

        $this->browseMode()->emitRefresh()->toastr('Qualification saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.qualification.index');
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
            'uploadedFile' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480',
        ];

    }

    public function getListeners()
    {
        return [
            'create-qualification' => 'create',
            'edit-qualification' => 'edit',
            'delete-qualification' => 'delete',
            'download-qualification' => 'download',
            'set-highest' => 'setHighest',
        ];
    }


}

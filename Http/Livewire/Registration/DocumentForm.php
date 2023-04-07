<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Document;
use Lumis\StaffManagement\Entities\DocumentType;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;

class DocumentForm extends LivewireUI
{
    use WithFileUploads;
    use WithEnums;

    public mixed $name;
    public mixed $documentType;
    public mixed $uploadedFile;
    public mixed $documents;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->documents = collect();
        $this->name = null;
        $this->documentType = null;
        $this->uploadedFile = null;
        $this->nextRoute = null;
        $this->recovery();
    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->documents = $staff->documents()->latest()->get();
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
        $this->with('documentType', DocumentType::pluck('id', 'name')->flip()->toArray());
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        return view("staffmanagement::livewire.registration.document.index");
    }

    public function cancel()
    {
        $this->resetFields();
        $this->browse();
    }

    public function resetFields()
    {
        $this->reset([
            'name',
            'documentType',
            'uploadedFile',
        ]);
    }

    public function browse()
    {
        $this->browseMode();
        $this->recovery();
    }

    public function delete($id)
    {
        Document::destroy($id);
        $this->browse();
        $this->toastr('Document deleted');
    }

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate([
            'name' => 'required|string',
            'uploadedFile' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480',
        ]);

        $staff = Staff::find(session()->get('staff'));
        $savedPath = $this->uploadedFile->storePublicly("staffmanagement/{$staff->id}/documents", 'public');

        $document = new Document();
        $document->name = $this->name;
        $document->size = $this->uploadedFile->getSize();
        $document->mime = $this->uploadedFile->getClientOriginalExtension();
        $document->path = $savedPath;
        $document->staff()->associate($staff);
        $document->documentType()->associate($this->documentType);
        $document->save();
        $this->resetFields();
        $this->toastr('Document saved');
    }
}

<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Document;
use Lumis\StaffManagement\Entities\DocumentType;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;
use Storage;

class DocumentPage extends LivewireUI
{
    use WithFileUploads, WithEnums;

    public Staff $staff;
    public mixed $name;
    public mixed $documentType;
    public mixed $uploadedFile;


    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function __construct()
    {
        parent::__construct();
        $this->name = null;
        $this->documentType = null;
        $this->uploadedFile = null;
    }

    public function create()
    {
        $this->reset(['name', 'documentType', 'uploadedFile']);
        $this->createMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('documentType', DocumentType::pluck('id', 'name')->flip()->toArray());
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($object)
    {
        Document::destroy($object);
        $this->browseMode()->emitRefresh()->toastr('Document deleted');
    }

    public function download($object)
    {
        $document = Document::find($object);
        $filePath = $document->filePath('public');
        $fileName = $document->fileName();
        return response()->download($filePath, $fileName)->deleteFileAfterSend(false);

    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'uploadedFile' => 'required|mimes:jpg,png,jpeg,doc,docx,pdf|max:20480',
        ]);

        $staffNo = $this->staff->id;
        $savedPath = $this->uploadedFile->storePublicly("staffmanagement/{$staffNo}/documents", 'public');

        $document = new Document();
        $document->name = $this->name;
        $document->size = $this->uploadedFile->getSize();
        $document->mime = $this->uploadedFile->getClientOriginalExtension();
        $document->path = $savedPath;
        $document->staff()->associate($this->staff);
        $document->documentType()->associate($this->documentType);
        $document->save();
        $this->browseMode()->emitRefresh()->toastr('Document saved');
    }

    public function render()
    {
        return view("staffmanagement::livewire.profile.document.index");
    }

    public function getListeners()
    {
        return [
            'create-document' => 'create',
            'delete-document' => 'delete',
            'download-document' => 'download'
        ];
    }

}

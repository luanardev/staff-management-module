<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\DocumentType;

class DocumentTypeConfig extends LivewireUI
{
    public DocumentType $documentType;

    public function __construct()
    {
        $this->documentType = new DocumentType();
    }

    public function render()
    {
        return view('staffmanagement::livewire.settings.document-type.index');
    }

    public function create()
    {
        $this->reset('documentType');
        $this->createMode();
    }

    public function edit($id = null)
    {
        $this->documentType = DocumentType::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        DocumentType::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Document Type deleted');
    }

    public function save()
    {
        $this->validate();
        $this->documentType->save();
        $this->browseMode()->emitRefresh()->toastr('Document Type saved');
    }

    public function rules()
    {
        return [
            'documentType.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-document-type' => 'create',
            'edit-document-type' => 'edit',
            'delete-document-type' => 'delete',
        ];
    }


}

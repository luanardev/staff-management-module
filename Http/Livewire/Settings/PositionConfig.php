<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Livewire\WithFileUploads;
use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Position;

class PositionConfig extends LivewireUI
{
    use WithFileUploads;

    public Position $position;

    public $importMode;

    public $importFile;


    public function __construct()
    {
        $this->position = new Position();
    }

    public function render()
    {
        return view('staffmanagement::livewire.settings.position.index');
    }

    public function create()
    {
        $this->reset('position');
        $this->createMode();
    }

    public function import()
    {
        $this->importMode = true;
        $this->browseMode = false;
    }

    public function edit($id = null)
    {
        $this->position = Position::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
        $this->importMode = false;
    }

    public function delete($keys)
    {
        Position::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Position deleted');
    }

    public function save()
    {
        $this->validate();
        $this->position->save();
        $this->browseMode()->emitRefresh()->toastr('Position saved');
    }

    public function rules()
    {
        return [
            'position.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-position' => 'create',
            'edit-position' => 'edit',
            'delete-position' => 'delete',
        ];
    }


}

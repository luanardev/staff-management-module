<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\QualificationLevel;

class QualificationLevelConfig extends LivewireUI
{
    public QualificationLevel $qualificationLevel;

    public function __construct()
    {
        $this->qualificationLevel = new QualificationLevel();
    }

    public function render()
    {
        return view('staffmanagement::livewire.settings.qualification-level.index');
    }

    public function create()
    {
        $this->reset('qualificationLevel');
        $this->createMode();
    }

    public function edit($id = null)
    {
        $this->qualificationLevel = QualificationLevel::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        QualificationLevel::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Qualification Level deleted');
    }

    public function save()
    {
        $this->validate();
        $this->qualificationLevel->save();
        $this->browseMode()->emitRefresh()->toastr('Qualification Level saved');
    }

    public function rules()
    {
        return [
            'qualificationLevel.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-qualification-level' => 'create',
            'edit-qualification-level' => 'edit',
            'delete-qualification-level' => 'delete',
        ];
    }


}

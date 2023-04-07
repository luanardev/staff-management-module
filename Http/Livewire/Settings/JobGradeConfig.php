<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\JobGrade;

class JobGradeConfig extends LivewireUI
{
    public JobGrade $grade;

    public function __construct()
    {
        $this->grade = new JobGrade();
    }

    public function render()
    {
        return view('staffmanagement::livewire.settings.job-grade.index');
    }

    public function create()
    {
        $this->reset('grade');
        $this->createMode();
    }

    public function edit($id = null)
    {
        $this->grade = JobGrade::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        JobGrade::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Grade deleted');
    }

    public function save()
    {
        $this->validate();
        $this->grade->save();
        $this->browseMode()->emitRefresh()->toastr('Grade saved');
    }

    public function rules()
    {
        return [
            'grade.name' => 'required|string',
            'grade.leave_days' => 'nullable|int',
        ];

    }

    public function getListeners()
    {
        return [
            'create-grade' => 'create',
            'edit-grade' => 'edit',
            'delete-grade' => 'delete',
        ];
    }


}

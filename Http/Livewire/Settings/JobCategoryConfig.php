<?php

namespace Lumis\StaffManagement\Http\Livewire\Settings;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\JobCategory;

class JobCategoryConfig extends LivewireUI
{
    public JobCategory $Jobcategory;

    public function __construct()
    {
        $this->jobcategory = new JobCategory();
    }

    public function render()
    {
        return view('staffmanagement::livewire.settings.job-category.index');
    }

    public function create()
    {
        $this->reset('jobCategory');
        $this->createMode();
    }

    public function edit($id = null)
    {
        $this->jobcategory = JobCategory::findorfail($id);
        $this->editMode();
    }

    public function show()
    {
        $this->browseMode();
    }

    public function delete($keys)
    {
        JobCategory::destroy($keys);
        $this->browseMode()->emitRefresh()->toastr('Job Category deleted');
    }

    public function save()
    {
        $this->validate();
        $this->jobcategory->save();
        $this->browseMode()->emitRefresh()->toastr('Job Category saved');
    }

    public function rules()
    {
        return [
            'jobcategory.name' => 'required|string',
        ];

    }

    public function getListeners()
    {
        return [
            'create-job-category' => 'create',
            'edit-job-category' => 'edit',
            'delete-job-category' => 'delete',
        ];
    }


}

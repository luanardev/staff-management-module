<?php

namespace Lumis\StaffManagement\Http\Livewire\Profile;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\Employment;
use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobGrade;
use Lumis\StaffManagement\Entities\JobNotch;
use Lumis\StaffManagement\Entities\JobRank;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Entities\Position;
use Lumis\StaffManagement\Entities\Staff;
use Lumis\StaffManagement\Enums\WithEnums;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;

class EmploymentPage extends LivewireUI
{
    use WithEnums;

    public Employment $employment;
    public Staff $staff;


    public function mount(Staff $staff)
    {
        $this->employment = $staff->employment;
    }

    public function edit($object = null)
    {
        $this->editMode();
        $this->viewData();
    }

    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('departments', Department::pluck('id', 'name')->flip()->toArray());
        $this->with('sections', Section::pluck('id', 'name')->flip()->toArray());
        $this->with('campuses', Campus::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('name')->toArray());
        $this->with('types', JobType::pluck('id', 'name')->flip()->toArray());
        $this->with('categories', JobCategory::pluck('id', 'name')->flip()->toArray());
        $this->with('statuses', JobStatus::pluck('id', 'name')->flip()->toArray());

    }

    public function show()
    {
        $this->browseMode();
    }

    public function save()
    {
        $this->validate();
        $this->employment->setKey($this->staff->getKey());
        $this->employment->setTenurePeriod(
            $this->employment->start_date,
            $this->employment->end_date
        );
        $this->employment->save();
        $this->browseMode()->emitRefresh()->toastr('Employment saved');
    }

    public function render()
    {
        return view('staffmanagement::livewire.profile.employment.index');
    }

    public function rules()
    {
        return [
            'employment.position_id' => 'required',
            'employment.job_rank_id' => 'nullable',
            'employment.job_type_id' => 'required',
            'employment.job_category_id' => 'required',
            'employment.job_status_id' => 'required',
            'employment.department_id' => 'required',
            'employment.section_id' => 'required',
            'employment.campus_id' => 'required',
            'employment.grade' => 'required|string',
            'employment.notch' => 'nullable|numeric',
            'employment.start_date' => 'required|date',
            'employment.end_date' => 'nullable|date'
        ];
    }

    public function notches()
    {
        return JobNotch::getByGrade($this->employment->grade)
            ->pluck('notch')->toArray();
    }

    public function ranks()
    {
        return JobRank::getByCategory($this->employment->job_category_id)
            ->pluck('id', 'name')->flip()->toArray();
    }
}

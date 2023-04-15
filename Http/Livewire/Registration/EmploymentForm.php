<?php

namespace Lumis\StaffManagement\Http\Livewire\Registration;

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
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;


class EmploymentForm extends LivewireUI
{
    public Employment $employment;
    public mixed $nextRoute;

    public function __construct()
    {
        parent::__construct();
        $this->nextRoute = null;
        $this->recovery();
    }

    public function recovery()
    {
        if (session()->exists('staff')) {
            $staff = Staff::find(session()->get('staff'));
            $this->employment = $staff->employment;
        } else {
            $this->employment = new Employment();
        }
    }

    public function mount($nextRoute)
    {
        $this->nextRoute = $nextRoute;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.registration.employment.create');
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

    public function save()
    {
        if (!session()->exists('staff')) {
            return false;
        }

        $this->validate();

        $employeeId = session()->get('staff');

        $this->employment->setKey($employeeId);
        $this->employment->setTenurePeriod(
            $this->employment->start_date,
            $this->employment->end_date
        );
        $this->employment->notch = 1;
        $this->employment->save();

        return $this->nextForm();
    }

    public function nextForm()
    {
        return $this->redirect(route($this->nextRoute));
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

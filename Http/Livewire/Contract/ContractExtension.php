<?php

namespace Lumis\StaffManagement\Http\Livewire\Contract;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\JobGrade;
use Lumis\StaffManagement\Entities\JobNotch;
use Lumis\StaffManagement\Entities\JobRank;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Entities\Position;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\ProgressType;
use Lumis\StaffManagement\Entities\Staff;


class ContractExtension extends LivewireUI
{
    public Staff $staff;
    public $position;
    public $jobRank;
    public $jobType;
    public $grade;
    public $notch = 1;
    public $startdate;
    public $enddate;

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
        $this->position = $staff->employment->position_id;
        $this->jobRank = $staff->employment->job_rank_id;
        $this->jobType = JobType::Contract();
        $this->grade = $staff->employment->grade;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.contract.contract-extension');
    }

    public function viewData()
    {
        $category = auth()->user()->getStaff()->job_category_id;
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('name')->toArray());
    }

    public function save()
    {
        if ($this->staff->isNotPermanent() && $this->staff->isNotTerminated()) {
            return toastrError('Cannot Extend Active Contract');
        }
        $this->validate();

        $progressType = ProgressType::Contract();
        $jobStatus = JobStatus::Serving();

        Progress::make(
            $this->staff,
            $progressType,
            $this->position,
            $this->jobRank,
            $this->jobType,
            $jobStatus,
            $this->grade,
            $this->notch,
            $this->startdate,
            $this->enddate
        );
        $this->emitRefresh()->toastr('Contract successful');

        return $this->redirect(route('contract.index'));

    }

    public function notches()
    {
        return JobNotch::getByGrade($this->grade)
            ->pluck('notch')->toArray();
    }

    public function ranks()
    {
        $category = $this->staff->employment->job_category_id;
        return JobRank::getByCategory($category)
            ->pluck('id', 'name')->flip()->toArray();
    }

    public function rules()
    {
        return [
            'position' => 'required|numeric',
            'jobRank' => 'required|numeric',
            'grade' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ];
    }

}

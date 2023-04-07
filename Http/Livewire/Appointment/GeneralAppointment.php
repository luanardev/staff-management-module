<?php

namespace Lumis\StaffManagement\Http\Livewire\Appointment;

use Luanardev\LivewireUI\LivewireUI;
use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobGrade;
use Lumis\StaffManagement\Entities\JobNotch;
use Lumis\StaffManagement\Entities\JobRank;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\StaffManagement\Entities\Position;
use Lumis\StaffManagement\Entities\Progress;
use Lumis\StaffManagement\Entities\ProgressType;
use Lumis\StaffManagement\Entities\Staff;

class GeneralAppointment extends LivewireUI
{
    public Staff $staff;
    public $position;
    public $jobRank;
    public $jobType;
    public $jobCategory;
    public $grade;
    public $notch = 1;
    public $startdate;
    public $enddate;
    private $progressType = 'Appointment';

    public function mount(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        $this->viewData();
        return view('staffmanagement::livewire.appointment.general.create');
    }

    public function viewData()
    {
        $this->with('positions', Position::pluck('id', 'name')->flip()->toArray());
        $this->with('categories', JobCategory::pluck('id', 'name')->flip()->toArray());
        $this->with('types', JobType::pluck('id', 'name')->flip()->toArray());
        $this->with('grades', JobGrade::pluck('name')->toArray());
    }

    public function save()
    {
        $this->validate();

        $progressType = ProgressType::Appointment();

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

        $this->browseMode()->emitRefresh()->toastr('Appointment saved');

        return $this->redirect(route('general.index'));
    }

    public function notches()
    {
        return JobNotch::getByGrade($this->grade)
            ->pluck('notch')->toArray();
    }

    public function ranks()
    {
        return JobRank::getByCategory($this->jobCategory)
            ->pluck('id', 'name')->flip()->toArray();
    }

    public function rules()
    {
        return [
            'position' => 'required',
            'jobRank' => 'required',
            'jobType' => 'required',
            'jobCategory' => 'required',
            'grade' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
        ];
    }


}

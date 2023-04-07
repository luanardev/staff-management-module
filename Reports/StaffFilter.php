<?php

namespace Lumis\StaffManagement\Reports;

use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobGrade;
use Lumis\StaffManagement\Entities\JobStatus;
use Lumis\StaffManagement\Entities\JobType;
use Lumis\Organization\Entities\Campus;
use Lumis\Organization\Entities\Department;
use Lumis\Organization\Entities\Section;
use Rappasoft\LaravelLivewireTables\Views\Filter;


class StaffFilter extends ReportFilter
{

    public function filters(): array
    {
        return [

            'campus' => Filter::make('Campus')->select(
                Campus::getByUser()->pluck('name')->toArray()
            ),

            'department' => Filter::make('Department')->select(
                Department::pluck('name')->toArray()
            ),

            'section' => Filter::make('Section')->select(
                Section::pluck('name')->toArray()
            ),

            'appointment' => Filter::make('Appointment')->select(
                JobType::pluck('name')->toArray()
            ),

            'category' => Filter::make('Category')->select(
                JobCategory::pluck('name')->toArray()
            ),

            'grade' => Filter::make('Grade')->select(
                JobGrade::pluck('name')->toArray()
            ),

            'status' => Filter::make('Status')->select(
                JobStatus::pluck('name')->toArray()
            )
        ];
    }

    public function groups(): array
    {
        return [
            'gender' => 'Gender',
            'department' => 'Department',
            'section' => 'Section',
            'appointment' => 'Appointment',
            'category' => 'Category',
            'grade' => 'JobGrade',
            'status' => 'Status',
        ];
    }


}

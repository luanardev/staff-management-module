<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\JobGrade;
use Lumis\StaffManagement\Entities\JobNotch;

class JobGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobGrades = [
            ['name' => 'A', 'leave_days' => 21, 'notches' => 9],
            ['name' => 'B', 'leave_days' => 21, 'notches' => 9],
            ['name' => 'C', 'leave_days' => 21, 'notches' => 9],
            ['name' => 'D', 'leave_days' => 24, 'notches' => 9],
            ['name' => 'E', 'leave_days' => 24, 'notches' => 8],
            ['name' => 'F', 'leave_days' => 24, 'notches' => 8],
            ['name' => 'G', 'leave_days' => 24, 'notches' => 8],
            ['name' => 'H', 'leave_days' => 30, 'notches' => 8],
            ['name' => 'I', 'leave_days' => 30, 'notches' => 8],
            ['name' => 'J', 'leave_days' => 30, 'notches' => 8],
            ['name' => 'K', 'leave_days' => 30, 'notches' => 8],
            ['name' => 'L', 'leave_days' => 30, 'notches' => 7],
            ['name' => 'M', 'leave_days' => 30, 'notches' => 19],
            ['name' => 'N', 'leave_days' => 30, 'notches' => 9],
            ['name' => 'O', 'leave_days' => 30, 'notches' => 13],
            ['name' => 'P', 'leave_days' => 30, 'notches' => 14],
            ['name' => 'Q', 'leave_days' => 30, 'notches' => 4],
            ['name' => 'R', 'leave_days' => 30, 'notches' => 4]
        ];

        $level = 0;

        foreach ($jobGrades as $record) {
            $jobGrade = new JobGrade();
            $jobGrade->name = $record['name'];
            $jobGrade->leave_days = $record['leave_days'];
            $jobGrade->level = ++$level;
            $jobGrade->save();

            $notches = $record['notches'];
            for($index = 1; $index <= $notches; $index++){
                $jobNotch = new JobNotch();
                $jobNotch->notch = $index;
                $jobNotch->grade = $jobGrade->name;
                $jobNotch->save();
            }

        }
    }


}

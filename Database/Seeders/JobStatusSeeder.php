<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\JobStatus;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobStatuses = [
            'Serving',
            'Probation',
            'Retired',
            'Resigned',
            'Deceased',
            'Dismissed',
            'Terminated',
            'OnLeave'
        ];

        foreach ($jobStatuses as $name) {
            $obj = new JobStatus();
            $obj->name = $name;
            $obj->save();
        }
    }

}

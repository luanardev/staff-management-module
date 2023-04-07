<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\JobType;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobTypes = [
            'Permanent',
            'Contract',
            'PartTime',
            'Secondment',
            'Temporary',
            'Adjunct',
            'Internship'
        ];

        foreach ($jobTypes as $name) {
            $obj = new JobType();
            $obj->name = $name;
            $obj->save();
        }
    }


}

<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\ProgressType;

class ProgressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $progressTypes = [
            ['name' => 'Permanent', 'description' => 'Permanent Appointment'],
            ['name' => 'Contract', 'description' => 'Contract Appointment'],
            ['name' => 'Promotion', 'description' => 'Grade Promotion'],
            ['name' => 'Increment', 'description' => 'Merit Increment'],
            ['name' => 'Appointment', 'description' => 'Internal Appointment'],
            ['name' => 'Temporary', 'description' => 'Temporary Appointment'],
            ['name' => 'Headship', 'description' => 'Head of Department'],
            ['name' => 'Deanship', 'description' => 'Dean of Faculty']

        ];

        foreach ($progressTypes as $type) {
            $obj = new ProgressType();
            $obj->name = $type['name'];
            $obj->description = $type['description'];
            $obj->save();
        }
    }

}

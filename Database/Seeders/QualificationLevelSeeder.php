<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\QualificationLevel;

class QualificationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualifications = [
            'PhD',
            'Masters Degree',
            'Postgraduate Diploma',
            'Postgraduate Certificate',
            'Honors Degree',
            'Bachelors Degree',
            'Advanced Diploma',
            'Diploma',
            'Professional Certificate',
            'Training Certificate',
            'University Certificate',
            'College Certificate',
            'Senior Secondary Certificate',
            'Junior Secondary Certificate',
            'Primary Education Certificate',
        ];

        foreach ($qualifications as $name) {
            $obj = new QualificationLevel();
            $obj->name = $name;
            $obj->save();
        }
    }

}

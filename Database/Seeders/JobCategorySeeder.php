<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\JobCategory;
use Lumis\StaffManagement\Entities\JobRank;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Academic' => [
                'Professor',
                'Associate Professor',
                'Senior Lecturer',
                'Lecturer'
            ],
            'Research' => [
                'Research Professor',
                'Associate Research Professor',
                'Senior Research Fellow',
                'Research Fellow'
            ],
            'Administrative' => [
                'Top Manager',
                'Middle Manager',
                'Manager',
                'Chief Officer',
                'Senior Officer',
                'Officer',
            ],
            'CTS' => [
                'Chief Rank',
                'Senior Rank',
                'Technician',
                'Clerical',
            ]
        ];

        foreach ($categories as $name => $ranks) {
            $category = new JobCategory();
            $category->name = $name;
            $category->save();
            foreach($ranks as $name){
                $rank = new JobRank();
                $rank->name = $name;
                $rank->jobcategory()->associate($category);
                $rank->save();
            }
        }

    }

}

<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class StaffManagementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            PositionSeeder::class,
            DocumentTypeSeeder::class,
            JobCategorySeeder::class,
            JobStatusSeeder::class,
            JobTypeSeeder::class,
            JobGradeSeeder::class,
            ProgressTypeSeeder::class,
            QualificationLevelSeeder::class
        ]);
    }
}

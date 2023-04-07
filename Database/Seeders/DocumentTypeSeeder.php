<?php

namespace Lumis\StaffManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Lumis\StaffManagement\Entities\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentTypes = [
            'National ID',
            'Driving Licence',
            'Passport',
            'Birth Certificate',
            'Death Certificate',
            'Medical Certificate',
            'Marriage Certificate',
            'Divorce Certificate',
            'Curriculum Vitae',
            'Cover Letter',
            'Academic Certificate',
            'Professional Certificate',
            'Training Certificate',
            'Industrial Certificate',
            'Achievement Award'
        ];

        foreach ($documentTypes as $name) {
            $document = new DocumentType();
            $document->name = $name;
            $document->save();
        }
    }


}

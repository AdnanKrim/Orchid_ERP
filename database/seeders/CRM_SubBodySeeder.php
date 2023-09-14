<?php

namespace Database\Seeders;

use App\Models\CRM\subjectAndBody;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CRM_SubBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        subjectAndBody::create([
            'type' => 'QUOTATION',
            'subject' => 'TEST SUBJECT',
            'body' => 'TEST BODY',
        ]);
        subjectAndBody::create([
            'type' => 'MEASUREMENT',
            'subject' => 'TEST SUBJECT',
            'body' => 'TEST BODY',
        ]);
    }
}

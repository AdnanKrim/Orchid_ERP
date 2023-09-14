<?php

namespace Database\Seeders;

use App\Models\Report\SalesReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesReport::factory()->count(10)->create();
    }
}

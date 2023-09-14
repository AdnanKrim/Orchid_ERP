<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DesignWork;

class DesignWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DesignWork::create([
                'workTime' => 70,
                'startDate' => '2022-08-03 05:44:44',
                'endDate' => '2022-08-03 05:44:44',
                'workProgress' => 'Pending',
                'assignTo' => 'Admin'

            ]);
        }
    }
}

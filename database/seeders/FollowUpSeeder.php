<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FollowUp\FollowUpGroup;

class FollowUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        FollowUpGroup::create([
            'groupName'=> 'Supplier',
            'groupToken' => 'suppliers',
        ]);
        FollowUpGroup::create([
            'groupName'=> 'All-Leeds',
            'groupToken' => 'all-leeds',
        ]);
        FollowUpGroup::create([
            'groupName'=> 'Success-Leeds',
            'groupToken' => 'success-leeds',
        ]);
        FollowUpGroup::create([
            'groupName'=> 'Client',
            'groupToken' => 'clients',
        ]);
    }
}

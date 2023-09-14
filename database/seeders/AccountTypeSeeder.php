<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account\AccountType;
class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'AccountType' => 'Assests',
        ]);
        AccountType::create([
            'AccountType' => 'Liabilities',
        ]);
        AccountType::create([
            'AccountType' => 'Owner Equality',
        ]);
        AccountType::create([
            'AccountType' => 'Income',
        ]);
        AccountType::create([
            'AccountType' => 'Expenses',
        ]);
        AccountType::create([
            'AccountType' => 'Cost of Good Sold',
        ]);
    }
}

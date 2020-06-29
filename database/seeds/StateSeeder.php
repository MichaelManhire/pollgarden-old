<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['name' => 'Alabama'],
            ['name' => 'Alaska'],
            ['name' => 'Arizona'],
            ['name' => 'Arkansas'],
            ['name' => 'California'],
            ['name' => 'Colorado'],
            ['name' => 'Connecticut'],
            ['name' => 'Delaware'],
            ['name' => 'Florida'],
            ['name' => 'Georgia'],
            ['name' => 'Hawaii'],
            ['name' => 'Idaho'],
            ['name' => 'Illinois'],
            ['name' => 'Indiana'],
            ['name' => 'Iowa'],
            ['name' => 'Kansas'],
            ['name' => 'Kentucky'],
            ['name' => 'Louisiana'],
            ['name' => 'Maine'],
            ['name' => 'Maryland'],
            ['name' => 'Massachusetts'],
            ['name' => 'Michigan'],
            ['name' => 'Minnesota'],
            ['name' => 'Mississippi'],
            ['name' => 'Missouri'],
            ['name' => 'Montana'],
            ['name' => 'Nebraska'],
            ['name' => 'Nevada'],
            ['name' => 'New Hampshire'],
            ['name' => 'New Jersey'],
            ['name' => 'New Mexico'],
            ['name' => 'New York'],
            ['name' => 'North Carolina'],
            ['name' => 'North Dakota'],
            ['name' => 'Ohio'],
            ['name' => 'Oklahoma'],
            ['name' => 'Oregon'],
            ['name' => 'Pennsylvania'],
            ['name' => 'Puerto Rico'],
            ['name' => 'Rhode Island'],
            ['name' => 'South Carolina'],
            ['name' => 'South Dakota'],
            ['name' => 'Tennessee'],
            ['name' => 'Texas'],
            ['name' => 'Utah'],
            ['name' => 'Vermont'],
            ['name' => 'Virginia'],
            ['name' => 'Washington'],
            ['name' => 'Washington, D.C.'],
            ['name' => 'West Virginia'],
            ['name' => 'Wisconsin'],
            ['name' => 'Wyoming'],
        ]);
    }
}

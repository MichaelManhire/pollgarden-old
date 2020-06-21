<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEthnicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_ethnicities')->insert([
            ['name' => 'White'],
            ['name' => 'Black'],
            ['name' => 'Hispanic'],
            ['name' => 'Asian'],
            ['name' => 'Biracial'],
            ['name' => 'Other'],
        ]);
    }
}

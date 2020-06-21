<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_genders')->insert([
            ['name' => 'Male'],
            ['name' => 'Female'],
            ['name' => 'Non-binary'],
        ]);
    }
}

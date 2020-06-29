<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_education_levels')->insert([
            ['name' => 'High School'],
            ['name' => 'Some College'],
            ['name' => 'College'],
            ['name' => 'Grad School'],
        ]);
    }
}

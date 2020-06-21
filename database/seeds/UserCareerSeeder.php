<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_careers')->insert([
            ['name' => 'Agriculture'],
            ['name' => 'Art & Design'],
            ['name' => 'Business'],
            ['name' => 'Construction'],
            ['name' => 'Education'],
            ['name' => 'Engineering'],
            ['name' => 'Entertainment'],
            ['name' => 'Food Service'],
            ['name' => 'Government'],
            ['name' => 'Healthcare'],
            ['name' => 'Law'],
            ['name' => 'Maintenance'],
            ['name' => 'Manufacturing'],
            ['name' => 'Marketing'],
            ['name' => 'Media'],
            ['name' => 'Military'],
            ['name' => 'Retail'],
            ['name' => 'Science'],
            ['name' => 'Technology'],
            ['name' => 'Therapy'],
        ]);
    }
}

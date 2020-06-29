<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_religions')->insert([
            ['name' => 'Christian'],
            ['name' => 'Jewish'],
            ['name' => 'Muslim'],
            ['name' => 'Hindu'],
            ['name' => 'Buddhist'],
            ['name' => 'Agnostic'],
            ['name' => 'Atheist'],
            ['name' => 'Other'],
        ]);
    }
}

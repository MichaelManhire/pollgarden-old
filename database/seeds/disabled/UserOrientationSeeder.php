<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserOrientationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_orientations')->insert([
            ['name' => 'Straight'],
            ['name' => 'Gay'],
            ['name' => 'Bi'],
            ['name' => 'Pansexual'],
            ['name' => 'Asexual'],
            ['name' => 'Other'],
        ]);
    }
}

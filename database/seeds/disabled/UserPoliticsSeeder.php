<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPoliticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_politics')->insert([
            ['name' => 'Conservative'],
            ['name' => 'Liberal'],
            ['name' => 'Moderate'],
            ['name' => 'Libertarian'],
            ['name' => 'Socialist'],
            ['name' => 'Other'],
        ]);
    }
}

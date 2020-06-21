<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserZodiacSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_zodiac_signs')->insert([
            ['name' => 'Aries'],
            ['name' => 'Taurus'],
            ['name' => 'Gemini'],
            ['name' => 'Cancer'],
            ['name' => 'Leo'],
            ['name' => 'Virgo'],
            ['name' => 'Libra'],
            ['name' => 'Scorpio'],
            ['name' => 'Sagitarrius'],
            ['name' => 'Capricorn'],
            ['name' => 'Aquarius'],
            ['name' => 'Pisces'],
        ]);
    }
}

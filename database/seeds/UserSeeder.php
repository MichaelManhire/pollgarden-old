<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Michael',
                'slug' => 'michael',
                'email' => 'michaelmanhire@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'avatar' => 'https://api.adorable.io/avatars/200/michael.png',
                'age' => 27,
                'gender_id' => 1,
                'country_id' => 1,
                'state_id' => 5,
                'education_level_id' => 2,
                'career_id' => 19,
                'ethnicity_id' => 1,
                'orientation_id' => 1,
                'zodiac_sign_id' => 2,
                'religion_id' => 6,
                'politics_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        factory(App\User::class, 20)->create();
    }
}

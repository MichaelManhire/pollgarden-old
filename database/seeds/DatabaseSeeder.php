<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserCareerSeeder::class);
        $this->call(UserCountrySeeder::class);
        $this->call(UserEducationLevelSeeder::class);
        $this->call(UserEthnicitySeeder::class);
        $this->call(UserGenderSeeder::class);
        $this->call(UserReligionSeeder::class);
        $this->call(UserOrientationSeeder::class);
        $this->call(UserPoliticsSeeder::class);
        $this->call(UserStateSeeder::class);
        $this->call(UserZodiacSignSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PollCategorySeeder::class);
        $this->call(PollSeeder::class);
        $this->call(VoteSeeder::class);
        $this->call(CommentSeeder::class);
    }
}

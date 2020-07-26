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
        $this->call(CountrySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(PollCategorySeeder::class);

        if (App::environment('local')) {
            $this->call(UserSeeder::class);
            $this->call(PollSeeder::class);
            $this->call(VoteSeeder::class);
            $this->call(CommentSeeder::class);
            $this->call(LikeSeeder::class);
        }
    }
}

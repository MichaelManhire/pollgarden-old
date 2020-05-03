<?php

use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Poll::class, 50)->create()->each(function ($poll) {
            for ($i = 0; $i < rand(2, 5); $i++) {
                $poll->options()->save(factory(App\PollOption::class)->make());
            }
        });
    }
}

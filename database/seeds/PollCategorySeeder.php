<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PollCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('poll_categories')->insert([
            [
                'name' => 'Random',
                'slug' => 'random',
                'color' => 'green',
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'color' => 'purple',
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'color' => 'yellow',
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'color' => 'red',
            ],
            [
                'name' => 'Society',
                'slug' => 'society',
                'color' => 'blue',
            ],
        ]);
    }
}

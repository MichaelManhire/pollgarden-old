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
                'color' => 'blue',
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'color' => 'yellow',
            ],
            [
                'name' => 'Life Experiences',
                'slug' => 'life-experiences',
                'color' => 'teal',
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'color' => 'red',
            ],
            [
                'name' => 'Relationships',
                'slug' => 'relationships',
                'color' => 'pink',
            ],
            [
                'name' => 'Religion',
                'slug' => 'religion',
                'color' => 'orange',
            ],
            [
                'name' => 'Science & Tech',
                'slug' => 'science-tech',
                'color' => 'gray',
            ],
        ]);
    }
}

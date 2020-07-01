<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 100; $i++) :
            DB::table('posts')
                ->insert([
                    'post' => $faker->paragraph,
                    'title' => $faker->sentence,
                    'category_id' => rand(1, 3),
                    'user_id' => rand(1, 3),
                ]);
        endfor;
    }
}

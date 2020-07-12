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
            DB::table('companies')
                ->insert([
                    'name' => $faker->name,
                    'logo' => $faker->imageUrl,
                    'email' => $faker->email,
                    'url' => $faker->url,
                ]);
        endfor;



        for ($i = 0; $i <= 100; $i++) :
            DB::table('employees')
                ->insert([
                    'first_name' => $faker->name,
                    'last_name' => $faker->name,
                    'email' => $faker->email,
                    'phone' => $faker->phoneNumber,
                    'company_id' => rand(1, 100),
                ]);
        endfor;
    }
}

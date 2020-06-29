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
        // $this->call(UsersTableSeeder::class);


        $faker = \Faker\Factory::create();

        for ($loop = 0; $loop < 40; $loop++) {
            \App\Models\Article\Article::create([
                'title' => "公開記事{$loop}",
                'body' => $faker->sentence,
                'is_publish' => 1
            ]);
        }

        for ($loop = 0; $loop < 40; $loop++) {
            \App\Models\Article\Article::create([
                'title' => "非公開記事{$loop}",
                'body' => $faker->sentence,
                'is_publish' => 0
            ]);
        }

    }
}

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


        \App\Models\Article\Category::create([
            'id'    => 1,
            'slug'  => "category1",
            'title' => "カテゴリー1",
        ]);

        \App\Models\Article\Category::create([
            'id'    => 2,
            'slug'  => "category2",
            'title' => "カテゴリー2",
        ]);

        \App\Models\Article\Category::create([
            'id'    => 3,
            'slug'  => "category3",
            'title' => "カテゴリー3",
        ]);


        for ($loop = 0; $loop < 40; $loop++) {
            $randomKey = rand(1, 3);

            \App\Models\Article\Article::create([
                'category_id' => $randomKey,
                'title'       => "公開記事{$loop}",
                'body'        => $faker->sentence,
                'date'        => $faker->dateTime,
                'is_publish'  => 1
            ]);
        }

        for ($loop = 0; $loop < 40; $loop++) {
            $randomKey = rand(1, 3);

            \App\Models\Article\Article::create([
                'category_id' => $randomKey,
                'title'       => "非公開記事{$loop}",
                'body'        => $faker->sentence,
                'date'        => $faker->dateTime,
                'is_publish'  => 0
            ]);
        }

    }
}

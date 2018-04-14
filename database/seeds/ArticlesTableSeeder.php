<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_ids = Category::all()->pluck('id')->toArray();
        $user_ids = User::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
            ->times(100)
            ->make()
            ->each(function ($article, $index) use ($faker, $category_ids, $user_ids) {
                $article->user_id = $faker->randomElement($user_ids);
                $article->category_id = $faker->randomElement($category_ids);
            });

        Article::insert($articles->toArray());
    }
}

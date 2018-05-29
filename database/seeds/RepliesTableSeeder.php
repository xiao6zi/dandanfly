<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Reply;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 user_id 数组
        // 获取 article_id 数组
        // 获取 faker 工具类 循环

        $faker = app(Faker\Generator::class);

        $user_ids = User::all()->pluck('id')->toArray();
        $articles_ids = Article::all()->pluck('id')->toArray();
        $source = ['ios', 'android', 'pc'];

        $replies = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($replies, $index) use ($faker, $user_ids, $articles_ids, $source) {
                $replies->user_id = $faker->randomElement($user_ids);
                $replies->article_id = $faker->randomElement($articles_ids);
                $replies->source = $faker->randomElement($source);
            });


        Reply::insert($replies->toArray());
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index) use ($faker) {
               $user->avatar = get_gravatar($user->email);
            });

        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($user_array);

        $user = User::find(1);
        $user->name = 'xiao6zi';
        $user->email = 'xiao6zi@qq.com';
        $user->avatar = 'https://i.loli.net/2018/11/10/5be6ebbcc4f30.jpg';
        $user->save();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\User;
class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::pluck('id')->toArray();
        $category_ids = \App\Models\Category::pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $replys = factory(Thread::class)
            ->times(50)
            ->make()->each(function ($u) use ($user_ids, $category_ids, $faker) {
                // 从用户 ID 数组中随机取出一个并赋值
                $u->user_id = $faker->randomElement($user_ids);
                $u->category_id = $faker->randomElement($category_ids);
                $u->save();
            });
    }
}

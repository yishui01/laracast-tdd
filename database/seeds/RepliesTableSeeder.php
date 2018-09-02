<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = \App\Models\User::pluck('id');
        $thread_ids = \App\Models\Thread::pluck('id');
        $faker = app(\Faker\Generator::class);
        factory(\App\Models\Reply::class)
            ->times(100)
            ->make()->each(function ($reply) use ($thread_ids, $user_ids, $faker) {
                $reply->user_id = $faker->randomElement($user_ids);
                $reply->thread_id = $faker->randomElement($thread_ids);
                $reply->save();
            });
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $replys = factory(User::class)
            ->times(50)
            ->create();
    }
}
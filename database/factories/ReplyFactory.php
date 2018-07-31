<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => function () { //这个带动创建User
            return factory('App\Models\Thread')->create()->id;
        },
        'user_id' => function () { //创建User
            return factory('App\Models\User')->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});

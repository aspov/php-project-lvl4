<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status_id' => function () {
            return App\TaskStatus::firstOrCreate(['name' => 'new']);
        },
        'creator_id' => function () {
            return App\User::first()->id;
        },
        'assigned_to_id' => function () {
            return App\User::first()->id;
        }
    ];
});

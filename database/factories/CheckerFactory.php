<?php

use App\Checker;
use App\User;
use Faker\Generator as Faker;

$factory->define(Checker::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'url'     => $faker->randomElement([route('test1'), route('test2')]),
    ];
});

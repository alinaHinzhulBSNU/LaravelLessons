<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\User;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'id' => function() {
            return factory(User::class)->create()->id;
        },
        'authorName' => $faker->sentence(5),
        'country' => $faker->sentence(5),
    ];
});

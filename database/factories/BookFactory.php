<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Author;
use App\User;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'id' => function() {
            return factory(User::class)->create()->id;
        },
        'name' => $faker->sentence(5),
        'author_id' => function() {
            return factory(Author::class)->create()->id;
        },
    ];
});

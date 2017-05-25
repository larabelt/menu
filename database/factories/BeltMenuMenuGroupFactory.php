<?php

$factory->define(Belt\Menu\MenuGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(3, true),
        'body' => $faker->paragraphs(3, true),
    ];
});
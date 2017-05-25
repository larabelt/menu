<?php

use Illuminate\Support\Str;

$factory->define(Belt\Menu\MenuItem::class, function (Faker\Generator $faker) {

    return [
        'label' => Str::title($faker->words(3, true)),
        'url' => sprintf('/%s', $faker->slug),
    ];
});
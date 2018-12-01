<?php

use Faker\Generator as Faker;


$factory->define(App\Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => App\Enums\EventStatusType::Published,
        'user_id' => function() {
            return App\User::find(1)->id;
        },
    ];
});

$factory->define(App\Show::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'start' => $faker->dateTimeBetween('+0 days', '+1 week'),
        'end' => $faker->dateTimeBetween('+1 week', '+2 week'),
        'event_id' => function() {
            return factory(App\Event::class)->create();
        },
    ];
});



$factory->define(App\Venue::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Stage::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'venue_id' => function() {
            return factory(App\Venue::class)->create();
        }
    ];
});

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'stage_id' => function() {
            return factory(App\Stage::class)->create();
        },
    ];
});

$factory->define(App\Seat::class, function (Faker $faker) {
    static $combos;
    $combos = $combos ?: [];
    $faker1 = $faker->numberBetween(1,20);
    while(($faker2 = $faker->numberBetween(1,30)) && in_array([$faker1, $faker2], $combos)) {}
    $combos[] = [$faker1, $faker2];
    return [
        'row_number' => $faker1,
        'seat_number' => $faker2,
        'section_id' => function() {
            return factory(App\Section::class)->create();
        },
    ];
});
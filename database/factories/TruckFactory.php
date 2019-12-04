<?php
/**
 * File: TruckFactory.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Truck::class, static function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2),
    ];
});

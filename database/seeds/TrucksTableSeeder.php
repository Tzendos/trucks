<?php
/**
 * File: TrucksTableSeeder.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class TrucksTableSeeder
 */
class TrucksTableSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'Citroen',
            'price' => 10.44,
        ],
        [
            'name' => 'Восьмая',
            'price' => 12.64,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (self::DATA as $datum) {
            \App\Models\Truck::updateOrCreate($datum);
        }
    }
}

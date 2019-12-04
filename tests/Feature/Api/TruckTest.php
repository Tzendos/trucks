<?php
/**
 * File: TruckTest.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Truck;

/**
 * Class TruckTest
 * @package Tests\Feature\Api
 */
class TruckTest extends TestCase
{
    public function testIndex(): void
    {
        /** @var Truck $truck */
        $truck = \factory(Truck::class)->create();

        $this
            ->get('/trucks')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $truck->id,
                'nameTruck' => $truck->name,
                'price' => (string)$truck->price,
            ]);
    }

    public function testShow(): void
    {
        /** @var Truck $truck */
        $truck = \factory(Truck::class)->create();

        $this
            ->get("/trucks/{$truck->id}")
            ->assertOk()
            ->assertJsonFragment([
                'id' => $truck->id,
                'nameTruck' => $truck->name,
                'price' => (string)$truck->price,
            ]);
    }

    public function testCreate(): void
    {
        /** @var Truck $truck */
        $truck = \factory(Truck::class)->make();

        $fillableFields = $truck->getFillable();

        $fields = [];
        foreach ($fillableFields as $field) {
            $fields[$field] = $truck->getAttribute($field);
        }

        $this
            ->post('/trucks/add', $fields)
            ->assertCreated()
            ->assertJsonFragment([
                'nameTruck' => $truck->name,
                'price' => $truck->price,
            ]);
    }

    public function testUpdate(): void
    {
        /** @var Truck $truck */
        $truck = \factory(Truck::class)->create();

        $newAttributes = [
            'name' => 'Test name',
            'price' => 123.12,
        ];

        $this
            ->patch("/trucks/{$truck->id}", $newAttributes)
            ->assertOk()
            ->assertJsonFragment([
                'nameTruck' => 'Test name',
                'price' => 123.12,
            ]);
    }

    public function testDestroy(): void
    {
        /** @var Truck $truck */
        $truck = \factory(Truck::class)->create();

        $this
            ->delete("/trucks/{$truck->id}")
            ->assertOk();

        $this->assertDatabaseMissing('trucks', [
            'id' => $truck->id,
            'name' => $truck->name,
            'price' => $truck->price,
        ]);
    }
}

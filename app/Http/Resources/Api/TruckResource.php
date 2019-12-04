<?php
/**
 * File: TruckResource.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TruckResource
 * @package App\Http\Resources
 *
 * @mixin \App\Models\Truck
 */
class TruckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nameTruck' => $this->name,
            'price' => $this->price,
        ];
    }
}

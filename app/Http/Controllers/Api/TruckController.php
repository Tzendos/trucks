<?php
/**
 * File: TruckController.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Truck;
use App\Http\Resources\TruckResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TruckCreateRequest;
use App\Http\Requests\Api\TruckUpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

/**
 * Class TruckController
 * @package App\Http\Controllers\Api
 */
class TruckController extends Controller
{
    /**
     * Show trucks list
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $trucks = Truck::all();
        return TruckResource::collection($trucks);
    }

    /**
     * Show truck record
     *
     * @param Request $request
     * @param Truck $truck
     * @return JsonResource
     */
    public function show(Request $request, Truck $truck): JsonResource
    {
        return new TruckResource($truck);
    }

    /**
     * Create truck record
     *
     * @param TruckCreateRequest $request
     * @return JsonResource
     */
    public function create(TruckCreateRequest $request): JsonResource
    {
        $attributions = $request->validated();
        $truck = Truck::create($attributions);

        return new TruckResource($truck);
    }

    /**
     * Update truck record
     *
     * @param TruckUpdateRequest $request
     * @param Truck $truck
     * @return JsonResource
     */
    public function update(TruckUpdateRequest $request, Truck $truck): JsonResource
    {
        $attributes = $request->validated();
        $truck->update($attributes);

        return new TruckResource($truck);
    }

    /**
     * Delete truck record
     *
     * @param Truck $truck
     * @throws \Exception
     */
    public function destroy(Truck $truck): void
    {
        $truck->delete();
    }
}

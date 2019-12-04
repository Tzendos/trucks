<?php
/**
 * File: TruckImgController.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TruckImgRequest;
use App\Models\Truck;
use App\Http\Controllers\Controller;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class TruckImgController
 * @package App\Http\Controllers\Api
 */
class TruckImgController extends Controller
{
    /**
     * Show img for truck
     *
     * @param Truck $truck
     * @return array
     */
    public function show(Truck $truck): array
    {
        $media = $truck->getPicture();

        if (!$media) {
            return [];
        }

        return [
            'url' => $media->getFullUrl(),
            'size' => $media->getHumanReadableSizeAttribute(),
        ];
    }

    /**
     * Create img for truck
     *
     * @param TruckImgRequest $request
     * @param Truck $truck
     * @return array
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws InvalidManipulation
     */
    public function create(TruckImgRequest $request, Truck $truck): array
    {
        $media = $this->saveImage($truck);

        return [
            'url' => $media->getFullUrl(),
            'size' => $media->getHumanReadableSizeAttribute(),
        ];
    }

    /**
     * Update img for truck
     *
     * @param TruckImgRequest $request
     * @param Truck $truck
     * @return array
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws InvalidManipulation
     */
    public function update(TruckImgRequest $request, Truck $truck): array
    {
        $media = $this->saveImage($truck);

        return [
            'url' => $media->getFullUrl(),
            'size' => $media->getHumanReadableSizeAttribute(),
        ];
    }

    /**
     * Remove truck img
     *
     * @param Truck $truck
     */
    public function destroy(Truck $truck): void
    {
        $truck->clearMediaCollection('pictures');
    }

    /**
     * @param Truck $truck
     * @return Media
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws InvalidManipulation
     */
    protected function saveImage(Truck $truck): Media
    {
        $truck->clearMediaCollection('pictures');
        $media = $truck->addMediaFromRequest('picture')
            ->usingFileName(uniqid('', true) . '.jpg')
            ->toMediaCollection('pictures');

        Image::load($media->getPath())
            ->width(640)
            ->format(Manipulations::FORMAT_JPG)
            ->save();

        return $media;
    }
}

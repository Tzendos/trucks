<?php
/**
 * File: Truck.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Truck
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Truck newModelQuery()
 * @method static Builder|Truck newQuery()
 * @method static Builder|Truck query()
 * @mixin \Eloquent
 */
class Truck extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'name',
        'price',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pictures');
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        /** @var Media $media */
        if($media = $this->getMedia('pictures')->first()) {
            return $media;
        }
        return null;
    }
}

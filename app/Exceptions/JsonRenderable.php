<?php
/**
 * File: JsonRenderable.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

/**
 * Interface JsonRenderable
 *
 * Adding ability to render exception as json
 */
interface JsonRenderable
{
    /**
     * Render exception as JsonResponse
     *
     * @return JsonResponse
     */
    public function renderAsJson(): JsonResponse;
}

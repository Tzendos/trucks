<?php
/**
 * File: WelcomeController.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class WelcomeController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(['copyright' => 'Vladimir Pogarsky (Tzendos)']);
    }
}

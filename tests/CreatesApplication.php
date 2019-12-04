<?php
/**
 * File: CreatesApplication.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}

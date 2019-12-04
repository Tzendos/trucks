<?php
/**
 * File: TestCase.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;
}

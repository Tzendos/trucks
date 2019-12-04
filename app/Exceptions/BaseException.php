<?php
/**
 * File: BaseException.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-11-26
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

/**
 * Class BaseException
 *
 * Base exception class which is JsonRenderable and can output result as JsonResponse
 */
abstract class BaseException extends \RuntimeException implements JsonRenderable
{
    /**
     * Data to render in response
     *
     * @var mixed
     */
    private $data;

    public function __construct(string $message = '', $data = null, int $code = 0, \Throwable $previous = null)
    {
        $this->data = $data;

        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return 500;
    }

    public function renderAsJson(): JsonResponse
    {
        return \response()->json([
            'message' => $this->getMessage(),
            'data' => $this->getData()
        ], $this->getStatusCode());
    }
}

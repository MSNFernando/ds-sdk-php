<?php

namespace Dreamscape\ResellerApiSdk\Exception;

use Throwable;

/**
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class InternalServerErrorException extends ResellerApiSdkException
{
    /**
     * Constructor.
     *
     * @param mixed $response
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($response, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            print_r($response, true),
            $code,
            $previous
        );
    }
}

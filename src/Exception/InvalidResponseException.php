<?php

namespace Dreamscape\ResellerApiSdk\Exception;

use Throwable;

/**
 * Exception for invalid API response.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class InvalidResponseException extends ResellerApiSdkException
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
            'The Reseller REST API has returned non-well formed response: ' . print_r($response, true),
            $code,
            $previous
        );
    }
}

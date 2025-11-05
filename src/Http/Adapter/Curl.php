<?php

namespace Dreamscape\ResellerApiSdk\Http\Adapter;

use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Transport\Curl as CurlTransport;
use Dreamscape\ResellerApiSdk\Http\Transport\AbstractTransport;

/**
 * HTTP adapter that uses the cURL HTTP transport.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Curl extends AbstractAdapter
{
    /**
     * @inheritDoc
     */
    protected static function initializeTransport(
        string $api_location,
        RequestOptions $request_options = null
    ): AbstractTransport {
        return new CurlTransport($api_location, $request_options);
    }
}

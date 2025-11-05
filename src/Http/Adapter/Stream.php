<?php

namespace Dreamscape\ResellerApiSdk\Http\Adapter;

use Dreamscape\ResellerApiSdk\Http\RequestOptions;
use Dreamscape\ResellerApiSdk\Http\Transport\AbstractTransport;
use Dreamscape\ResellerApiSdk\Http\Transport\Stream as StreamTransport;

/**
 * HTTP adapter that uses the stream HTTP transport.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Stream extends AbstractAdapter
{
    /**
     * @inheritDoc
     */
    protected static function initializeTransport(
        string $api_location,
        RequestOptions $request_options = null
    ): AbstractTransport {
        return new StreamTransport($api_location, $request_options);
    }
}

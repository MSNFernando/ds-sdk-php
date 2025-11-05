<?php

namespace Dreamscape\ResellerApiSdk;

use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\Response;

/**
 * Interface for SDK request logger.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
interface RequestLogger
{
    /**
     * @param Request $request
     * @param Response $response
     */
    public function log(Request $request, Response $response);
}

<?php

namespace Dreamscape\ResellerApiSdk\Authenticator;

use Dreamscape\ResellerApiSdk\Http\Request;

/**
 * Interface for authenticators.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
interface Authenticator
{
    /**
     * Authenticates the request to Reseller REST API.
     * This method can modify the HTTP request to implement
     * the selected mechanism of authentication.
     *
     * @param Request $request
     */
    public function authenticate(Request $request): void;
}

<?php

namespace Dreamscape\ResellerApiSdk\Authenticator;

use Dreamscape\ResellerApiSdk\Http\Request;
use InvalidArgumentException;

/**
 * Implementation of authenticator that perform
 * the authentication with use of Reseller API Key.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class ApiKey implements Authenticator
{
    private string $api_key;

    /**
     * Constructor.
     *
     * @param string $api_key
     */
    public function __construct(string $api_key)
    {
        if (empty($api_key)) {
            throw new InvalidArgumentException('The argument $api_key must be not empty string');
        }

        $this->api_key = $api_key;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request): void
    {
        $request_id = md5(uniqid() . microtime(true));
        $signature = md5($request_id . $this->api_key);

        $request->setHeader('Api-Request-Id', $request_id)
            ->setHeader('Api-Signature', $signature);
    }
}

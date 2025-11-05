<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

/**
 * Service API methods.
 *
 * @title Service API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Service extends AbstractEndpoint
{
    /**
     * Pings the service.
     *
     * @return bool
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $is_alive = $api->service->ping();
     */
    public function ping(): bool
    {
        return (bool) $this->sendGetRequest('ping')['status'];
    }
}

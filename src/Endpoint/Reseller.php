<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;

/**
 * SDK API for working with reseller.
 *
 * @title Reseller API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Reseller extends AbstractEndpoint
{
    /**
     * Returns the reseller details.
     *
     * @return DataObject\Reseller\Existing
     * @throws AuthenticationException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $reseller = $api->reseller->getDetails();
     *
     *      echo 'Reseller ID: ' . $reseller->id . PHP_EOL;
     *      echo 'First Name: ' . $reseller->firstName . PHP_EOL;
     *      echo 'Last Name: ' . $reseller->lastName . PHP_EOL;
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(): DataObject\Reseller\Existing
    {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('reseller'),
            DataObject\Reseller\Existing::class
        );
    }
}

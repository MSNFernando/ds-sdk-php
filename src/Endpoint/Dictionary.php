<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;

/**
 * SDK API for working with dictionary.
 *
 * @title Dictionary API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Dictionary extends AbstractEndpoint
{
    /**
     * Returns the list of SSL Server Software.
     *
     * @return DataObject\Dictionary\SSLServerSoftware[]|DataObject\Collection
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
     *      $serverSoftwareList = $api->dictionary->getSslServerSoftware();
     *
     *      foreach ($serverSoftwareList as $serverSoftware) {
     *          echo 'ID: ' . $serverSoftware->id . PHP_EOL;
     *          echo 'Name: ' . $serverSoftware->name . PHP_EOL;
     *          echo PHP_EOL;
     *      }
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getSslServerSoftware(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('dictionary/ssl-server-software'),
            DataObject\Dictionary\SSLServerSoftware::class
        );
    }

    /**
     * Returns the list of Servers product operating systems.
     *
     * @return DataObject\Dictionary\ServersOperatingSystem[]|DataObject\Collection
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
     *      $operatingSystems = $api->dictionary->getServersOperatingSystems();
     *
     *      foreach ($operatingSystems as $operatingSystem) {
     *          echo 'Family: ' . $operatingSystem->family . PHP_EOL;
     *          echo 'Name: ' . $operatingSystem->name . PHP_EOL;
     *          echo PHP_EOL;
     *      }
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getServersOperatingSystems(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('dictionary/servers-operating-systems'),
            DataObject\Dictionary\ServersOperatingSystem::class
        );
    }

    /**
     * Returns the list of Servers product locations.
     *
     * @return DataObject\Dictionary\ServersLocation[]|DataObject\Collection
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
     *      $locations = $api->dictionary->getServersLocations();
     *
     *      foreach ($locations as $location) {
     *          echo 'Code: ' . $location->code . PHP_EOL;
     *          echo 'Name: ' . $location->name . PHP_EOL;
     *          echo PHP_EOL;
     *      }
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getServersLocations(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('dictionary/servers-locations'),
            DataObject\Dictionary\ServersLocation::class
        );
    }

    /**
     * Returns the list of WordPress product locations.
     *
     * @return DataObject\Dictionary\WordPressLocation[]|DataObject\Collection
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
     *      $locations = $api->dictionary->getWordPressLocations();
     *
     *      foreach ($locations as $location) {
     *          echo 'Code: ' . $location->code . PHP_EOL;
     *          echo 'Name: ' . $location->name . PHP_EOL;
     *          echo PHP_EOL;
     *      }
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getWordPressLocations(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('dictionary/wordpress-locations'),
            DataObject\Dictionary\WordPressLocation::class
        );
    }

    /**
     * Returns the list of Fax to Email product locations.
     *
     * @return DataObject\Dictionary\FaxToEmailLocation[]|DataObject\Collection
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
     *      $locations = $api->dictionary->getFaxToEmailLocations();
     *
     *      foreach ($locations as $location) {
     *          echo 'Country: ' . $location->countryName . PHP_EOL;
     *          echo 'State: ' . $location->stateName . PHP_EOL;
     *          echo PHP_EOL;
     *      }
     * } catch (Exception\AuthenticationException $e) {
     *      // Handle the exception.
     * }
     */
    public function getFaxToEmailLocations(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('dictionary/fax-to-email-locations'),
            DataObject\Dictionary\FaxToEmailLocation::class
        );
    }
}

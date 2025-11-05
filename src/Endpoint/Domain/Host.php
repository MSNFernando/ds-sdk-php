<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Domain;

use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\DataObject\Helper;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use InvalidArgumentException;

/**
 * SDK API for working with domain hosts.
 *
 * @title Domain Host API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Host extends AbstractEndpoint
{
    /**
     * Creates new host.
     *
     * @param int $domain_id
     * @param DataObject\Domain\Host\Create $data_object
     *
     * @return DataObject\Domain\Host\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $domain_id = 123456;
     * $new_host = DataObject\Domain\Host\Create::build();
     * $new_host->host = 'some-host.crazydomains.com.au';
     * $new_host->ip = '27.124.125.143';
     *
     * try {
     *      $host = $api->domains->hosts->create($domain_id, $new_host);
     *
     *      echo 'Host: ' . $host->host . PHP_EOL;
     *      echo 'IP: ' . $host->ip . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function create(int $domain_id, DataObject\Domain\Host\Create $data_object): DataObject\Domain\Host\Existing
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return Helper::convertResponseToDataObject(
            $this->sendPostRequest('/domains/' . $domain_id . '/hosts', $data_object->toRequestArray()),
            DataObject\Domain\Host\Existing::class
        );
    }

    /**
     * Returns the list of hosts.
     *
     * @param int $domain_id
     *
     * @return DataObject\Domain\Host\Existing[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $domain_id = 123456;
     *
     * try {
     *      $hosts = $api->domains->hosts->getAll($domain_id);
     *
     *      foreach ($hosts as $host) {
     *          echo 'Host: ' . $host->host . PHP_EOL;
     *          echo 'IP: ' . $host->ip . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getAll(int $domain_id): DataObject\Collection
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('/domains/' . $domain_id . '/hosts'),
            DataObject\Domain\Host\Existing::class
        );
    }

    /**
     * Returns the details about single host.
     *
     * @param int $domain_id
     * @param string $host
     *
     * @return DataObject\Domain\Host\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $domain_id = 123456;
     * $hostname = 'some-host.crazydomains.com.au';
     *
     * try {
     *      $host = $api->domains->hosts->getDetails($domain_id, $hostname);
     *
     *      echo 'Host: ' . $host->host . PHP_EOL;
     *      echo 'IP: ' . $host->ip . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $domain_id, string $host): DataObject\Domain\Host\Existing
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if (empty($host)) {
            throw new InvalidArgumentException('The argument $host must be not empty string');
        }

        return Helper::convertResponseToDataObject(
            $this->sendGetRequest('/domains/' . $domain_id . '/hosts/' . $host),
            DataObject\Domain\Host\Existing::class
        );
    }

    /**
     * Updates the details for a single host.
     *
     * @param int $domain_id
     * @param string $host
     * @param DataObject\Domain\Host\Update $data_object
     *
     * @return DataObject\Domain\Host\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $domain_id = 123456;
     * $hostname = 'some-host.crazydomains.com.au';
     * $update_host = DataObject\Domain\Host\Update::build();
     * $update_host->ip = '27.124.125.143';
     *
     * try {
     *      $host = $api->domains->hosts->update($domain_id, $hostname, $update_host);
     *
     *      echo 'Host: ' . $host->host . PHP_EOL;
     *      echo 'IP: ' . $host->ip . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function update(
        int $domain_id,
        string $host,
        DataObject\Domain\Host\Update $data_object
    ): DataObject\Domain\Host\Existing {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if (empty($host)) {
            throw new InvalidArgumentException('The argument $host must be not empty string');
        }

        return Helper::convertResponseToDataObject(
            $this->sendPatchRequest('/domains/' . $domain_id . '/hosts/' . $host, $data_object->toRequestArray()),
            DataObject\Domain\Host\Existing::class
        );
    }

    /**
     * Deletes host.
     *
     * @param int $domain_id
     * @param string $host
     *
     * @return bool
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $domain_id = 123456;
     * $hostname = 'some-host.crazydomains.com.au';
     *
     * try {
     *      $api->domains->hosts->delete($domain_id, $hostname);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function delete(int $domain_id, string $host): bool
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if (empty($host)) {
            throw new InvalidArgumentException('The argument $host must be not empty string');
        }

        return $this->sendDeleteRequest('/domains/' . $domain_id . '/hosts/' . $host);
    }
}

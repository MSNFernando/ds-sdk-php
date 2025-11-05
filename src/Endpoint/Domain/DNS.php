<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Domain;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\DataObject\Helper;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\InvalidResponseException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use InvalidArgumentException;

/**
 * SDK API for working with domain DNS records.
 *
 * @title Domain DNS API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class DNS extends AbstractEndpoint
{
    /**
     * Returns the list of DNS records for a domain.
     *
     * The returned list is the collection of the inheritances
     * of the `DataObject\Domain\DNS\Existing\AbstractRecord` class.
     * For each DNS record the class in the `DataObject\Domain\DNS\Existing` namespace exists.
     *
     * @param int $domain_id
     * @param Filter\Domain\DNS\GetAll|null $filters
     *
     * @return DataObject\Domain\DNS\Existing\AbstractRecord[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\Filter;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dns_records = $api->domains->dns->getAll(123456);
     *
     *      foreach ($dns_records as $dns_record) {
     *          echo 'ID: ' . $dns_record->id . PHP_EOL;
     *          echo 'Type: ' . $dns_record->type . PHP_EOL;
     *
     *          if ($dns_record instanceof DataObject\Domain\DNS\Existing\A) {
     *              echo 'Subdomain: ' . $dns_record->subdomain . PHP_EOL;
     *              echo 'Content: ' . $dns_record->content . PHP_EOL;
     *          }
     *
     *          if ($dns_record instanceof DataObject\Domain\DNS\Existing\MX) {
     *              echo 'Subdomain: ' . $dns_record->subdomain . PHP_EOL;
     *              echo 'Content: ' . $dns_record->content . PHP_EOL;
     *              echo 'Priority: ' . $dns_record->priority . PHP_EOL;
     *          }
     *
     *          // There are data-object for all other DNS record in the DataObject\Domain\DNS\Existing namespace.
     *      }
     *
     *      // Get only SRV records
     *      $srv_dns_records = $api->domains->dns->getAll(
     *          123456,
     *          Filter\Domain\DNS\GetAll::build([ 'type' => PredefinedValue\Domain\DNS::SRV ])
     *      );
     *
     *      foreach ($srv_dns_records as $srv_dns_record) {
     *          \/* @var $srv_dns_record DataObject\Domain\DNS\Existing\SRV *\/
     *          echo 'ID: ' . $srv_dns_record->id . PHP_EOL;
     *          echo 'Subdomain: ' . $srv_dns_record->subdomain . PHP_EOL;
     *          echo 'Weight: ' . $srv_dns_record->weight . PHP_EOL;
     *          echo 'Port: ' . $srv_dns_record->port . PHP_EOL;
     *          echo 'Target: ' . $srv_dns_record->target . PHP_EOL;
     *          echo 'Priority: ' . $srv_dns_record->priority . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getAll(int $domain_id, Filter\Domain\DNS\GetAll $filters = null): DataObject\Collection
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        $response = $this->sendGetRequest(
            '/domains/' . $domain_id . '/dns',
            $filters ? $filters->toRequestArray() : []
        );
        $collection = DataObject\Collection::build(
            DataObject\Domain\DNS\Existing\AbstractRecord::class,
            count($response['data'])
        );

        foreach ($response['data'] as $item) {
            if (!isset($item['type'])) {
                throw new InvalidResponseException($response);
            }

            $collection->add(Helper::convertResponseToDataObject(
                [ 'data' => $item ],
                DataObject\Domain\DNS\Existing\AbstractRecord::getRecordClassByType($item['type'])
            ));
        }

        return $collection;
    }

    /**
     * Returns the details about single DNS record for a domain.
     *
     * The returned object is the instance of the `DataObject\Domain\DNS\Existing\*` class.
     *
     * @param int $domain_id
     * @param int $dns_record_id
     *
     * @return DataObject\Domain\DNS\Existing\AbstractRecord
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
     * try {
     *     $dns_record = $api->domains->dns->getDetails(123, 123);
     *
     *      echo 'ID: ' . $dns_record->id . PHP_EOL;
     *      echo 'Type: ' . $dns_record->type . PHP_EOL;
     *
     *      if ($dns_record instanceof DataObject\Domain\DNS\Existing\MAILFWD) {
     *          echo 'Email: ' . $dns_record->email . PHP_EOL;
     *          echo 'Forward to: ' . $dns_record->forwardTo . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $domain_id, int $dns_record_id): DataObject\Domain\DNS\Existing\AbstractRecord
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if ($dns_record_id < 1) {
            throw new InvalidArgumentException('The argument $dns_record_id must be positive integer');
        }

        $response = $this->sendGetRequest('/domains/' . $domain_id . '/dns/' . $dns_record_id);

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Domain\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Creates new DNS record of the specified domain.
     *
     * @param int $domain_id
     * @param DataObject\Domain\DNS\Create\AbstractRecord $data_object
     *
     * @return DataObject\Domain\DNS\Existing\AbstractRecord
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
     * $srv_record = DataObject\Domain\DNS\Create\SRV::build();
     *
     * $srv_record->subdomain = 'www';
     * $srv_record->priority = 10;
     * $srv_record->weight = 20;
     * $srv_record->port = 5000;
     * $srv_record->target = 'sip-server.example.com';
     *
     * try {
     *      $dns_record = $api->domains->dns->create(123456, $srv_record);
     *
     *      echo 'ID: ' . $dns_record->id;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function create(
        int $domain_id,
        DataObject\Domain\DNS\Create\AbstractRecord $data_object
    ): DataObject\Domain\DNS\Existing\AbstractRecord {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        $response = $this->sendPostRequest('/domains/' . $domain_id . '/dns', $data_object->toRequestArray());

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Domain\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Updates the details of the single DNS record for a domain.
     *
     * @param int $domain_id
     * @param int $dns_record_id
     * @param DataObject\Domain\DNS\Update\AbstractRecord $data_object
     *
     * @return DataObject\Domain\DNS\Existing\AbstractRecord
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
     * $update_webfwd_record = DataObject\Domain\DNS\Update\WEBFWD::build();
     *
     * $update_webfwd_record->forwardTo = 'https://crazydomains.com.au';
     * $update_webfwd_record->cloak = true;
     *
     * try {
     *      $dns_record = $api->domains->dns->update(123, 123, $update_webfwd_record);
     *
     *      echo 'ID: ' . $dns_record->id . PHP_EOL;
     *      echo 'Type: ' . $dns_record->type . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function update(
        int $domain_id,
        int $dns_record_id,
        DataObject\Domain\DNS\Update\AbstractRecord $data_object
    ): DataObject\Domain\DNS\Existing\AbstractRecord {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if ($dns_record_id < 1) {
            throw new InvalidArgumentException('The argument $dns_record_id must be positive integer');
        }

        $response = $this->sendPatchRequest(
            '/domains/' . $domain_id . '/dns/' . $dns_record_id,
            $data_object->toRequestArray()
        );

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Domain\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Deletes the single DNS record for a domain.
     *
     * @param int $domain_id
     * @param int $dns_record_id
     *
     * @return bool
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $dns_record = $api->domains->dns->delete(123, 123);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function delete(int $domain_id, int $dns_record_id): bool
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        if ($dns_record_id < 1) {
            throw new InvalidArgumentException('The argument $dns_record_id must be positive integer');
        }

        return $this->sendDeleteRequest('/domains/' . $domain_id . '/dns/' . $dns_record_id);
    }
}

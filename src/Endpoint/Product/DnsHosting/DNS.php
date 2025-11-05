<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product\DnsHosting;

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
 * SDK API for working with DNS hosting DNS records.
 *
 * @title DNS Hosting Product DNS Records API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class DNS extends AbstractEndpoint
{
    /**
     * Returns the list of DNS records for a DNS Hosting product.
     *
     * The returned list is the collection of the inheritances
     * of the `DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord` class.
     * For each DNS record the class in the `DataObject\Product\DnsHosting\DNS\Existing` namespace exists.
     *
     * @param int $product_id
     * @param Filter\Product\DnsHosting\DNS\GetAll|null $filters
     *
     * @return DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord[]|DataObject\Collection
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
     *      $dns_records = $api->products->dnsHostings->dns->getAll(123456);
     *
     *      foreach ($dns_records as $dns_record) {
     *          echo 'ID: ' . $dns_record->id . PHP_EOL;
     *          echo 'Type: ' . $dns_record->type . PHP_EOL;
     *
     *          if ($dns_record instanceof DataObject\Product\DnsHosting\DNS\Existing\A) {
     *              echo 'Subdomain: ' . $dns_record->subdomain . PHP_EOL;
     *              echo 'Content: ' . $dns_record->content . PHP_EOL;
     *          }
     *
     *          if ($dns_record instanceof DataObject\Product\DnsHosting\DNS\Existing\MX) {
     *              echo 'Subdomain: ' . $dns_record->subdomain . PHP_EOL;
     *              echo 'Content: ' . $dns_record->content . PHP_EOL;
     *              echo 'Priority: ' . $dns_record->priority . PHP_EOL;
     *          }
     *
     *          // There are data-object for all other DNS record in the DataObject\Product\DnsHosting\DNS\Existing namespace.
     *
     *          echo '----' . PHP_EOL;
     *      }
     *
     *      // Get only SRV records
     *      $srv_dns_records = $api->products->dnsHostings->dns->getAll(
     *          123456,
     *          Filter\Product\DnsHosting\DNS\GetAll::build([ 'type' => PredefinedValue\Domain\DNS::SRV ])
     *      );
     *
     *      foreach ($srv_dns_records as $srv_dns_record) {
     *          \/* @var $srv_dns_record DataObject\Product\DnsHosting\DNS\Existing\SRV *\/
     *          echo 'ID: ' . $srv_dns_record->id . PHP_EOL;
     *          echo 'Subdomain: ' . $srv_dns_record->subdomain . PHP_EOL;
     *          echo 'Weight: ' . $srv_dns_record->weight . PHP_EOL;
     *          echo 'Port: ' . $srv_dns_record->port . PHP_EOL;
     *          echo 'Target: ' . $srv_dns_record->target . PHP_EOL;
     *          echo 'Priority: ' . $srv_dns_record->priority . PHP_EOL;
     *          echo '----' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      echo $e->getMessage() . PHP_EOL;
     * }
     */
    public function getAll(
        int $product_id,
        Filter\Product\DnsHosting\DNS\GetAll $filters = null
    ): DataObject\Collection {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        $response = $this->sendGetRequest(
            '/products/dns-hostings/' . $product_id . '/dns',
            $filters ? $filters->toRequestArray() : []
        );
        $collection = DataObject\Collection::build(
            DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord::class,
            count($response['data'])
        );

        foreach ($response['data'] as $item) {
            if (!isset($item['type'])) {
                throw new InvalidResponseException($response);
            }

            $collection->add(Helper::convertResponseToDataObject(
                [ 'data' => $item ],
                DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord::getRecordClassByType($item['type'])
            ));
        }

        return $collection;
    }

    /**
     * Returns the details about single DNS record for a DNS Hosting product.
     *
     * The returned object is the instance of the `DataObject\Product\DnsHosting\DNS\Existing\*` class.
     *
     * @param int $product_id
     * @param int $record_id
     *
     * @return DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord
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
     *     $dns_record = $api->products->dnsHostings->dns->getDetails(123, 123);
     *
     *      echo 'ID: ' . $dns_record->id . PHP_EOL;
     *      echo 'Type: ' . $dns_record->type . PHP_EOL;
     *
     *      if ($dns_record instanceof DataObject\Product\DnsHosting\DNS\Existing\MAILFWD) {
     *          echo 'Email: ' . $dns_record->email . PHP_EOL;
     *          echo 'Forward to: ' . $dns_record->forwardTo . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      echo $e->getMessage() . PHP_EOL;
     * }
     */
    public function getDetails(int $product_id, int $record_id): DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        if ($record_id < 1) {
            throw new InvalidArgumentException('The argument $record_id must be positive integer');
        }

        $response = $this->sendGetRequest('/products/dns-hostings/' . $product_id . '/dns/' . $record_id);

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Creates new DNS record of the specified DNS Hosting product.
     *
     * @param int $product_id
     * @param DataObject\Product\DnsHosting\DNS\Create\AbstractRecord $data_object
     *
     * @return DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord
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
     * $srv_record = DataObject\Product\DnsHosting\DNS\Create\SRV::build();
     *
     * $srv_record->subdomain = 'www';
     * $srv_record->priority = 10;
     * $srv_record->weight = 20;
     * $srv_record->port = 5000;
     * $srv_record->target = 'sip-server.example.com';
     *
     * try {
     *      $dns_record = $api->products->dnsHostings->dns->create(123456, $srv_record);
     *
     *      echo 'ID: ' . $dns_record->id;
     * } catch (Exception\NotFoundException $e) {
     *      echo $e->getMessage() . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      print_r($e->getErrors());
     * }
     */
    public function create(
        int $product_id,
        DataObject\Product\DnsHosting\DNS\Create\AbstractRecord $data_object
    ): DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        $response = $this->sendPostRequest('/products/dns-hostings/' . $product_id . '/dns', $data_object->toRequestArray());

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Updates the details of the single DNS record for a DNS Hosting product.
     *
     * @param int $product_id
     * @param int $record_id
     * @param DataObject\Product\DnsHosting\DNS\Update\AbstractRecord $data_object
     *
     * @return DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord
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
     * $update_webfwd_record = DataObject\Product\DnsHosting\DNS\Update\WEBFWD::build();
     *
     * $update_webfwd_record->forwardTo = 'https://crazydomains.com.au';
     * $update_webfwd_record->cloak = true;
     *
     * try {
     *      $dns_record = $api->products->dnsHostings->dns->update(123, 123, $update_webfwd_record);
     *
     *      echo 'ID: ' . $dns_record->id . PHP_EOL;
     *      echo 'Type: ' . $dns_record->type . PHP_EOL;
     *      echo 'Forward to: ' . $dns_record->forwardTo . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      echo $e->getMessage() . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      print_r($e->getErrors());
     * }
     */
    public function update(
        int $product_id,
        int $record_id,
        DataObject\Product\DnsHosting\DNS\Update\AbstractRecord $data_object
    ): DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        if ($record_id < 1) {
            throw new InvalidArgumentException('The argument $record_id must be positive integer');
        }

        $response = $this->sendPatchRequest(
            '/products/dns-hostings/' . $product_id . '/dns/' . $record_id,
            $data_object->toRequestArray()
        );

        if (!isset($response['data']['type'])) {
            throw new InvalidResponseException($response);
        }

        return Helper::convertResponseToDataObject(
            $response,
            DataObject\Product\DnsHosting\DNS\Existing\AbstractRecord::getRecordClassByType($response['data']['type'])
        );
    }

    /**
     * Deletes the single DNS record for a DNS Hosting product.
     *
     * @param int $product_id
     * @param int $record_id
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
     *      $dns_record = $api->products->dnsHostings->dns->delete(123, 123);
     *
     *      echo 'Record deleted' . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      echo $e->getMessage() . PHP_EOL;
     * }
     */
    public function delete(int $product_id, int $record_id): bool
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        if ($record_id < 1) {
            throw new InvalidArgumentException('The argument $record_id must be positive integer');
        }

        return $this->sendDeleteRequest('/products/dns-hostings/' . $product_id . '/dns/' . $record_id);
    }
}

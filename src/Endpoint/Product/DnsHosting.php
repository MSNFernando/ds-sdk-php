<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use InvalidArgumentException;

/**
 * SDK API for working with Dns Hosting products.
 *
 * @property-read DnsHosting\DNS $dns
 *
 * @title DNS Hosting Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class DnsHosting extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'dns' => DnsHosting\DNS::class,
    ];

    /**
     * Returns the list of existing DNS Hosting products.
     *
     * @param Filter\Product\DnsHosting\GetAll|null $filters
     *
     * @return DataObject\Product\DnsHosting\Existing[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Filter;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $filters = Filter\Product\DnsHosting\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->dnsHostings->getAll($filters);
     *
     *      foreach ($products as $product) {
     *          echo 'Product ID: ' . $product->id . PHP_EOL;
     *          echo 'Domain Name: ' . $product->domainName . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $products->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $products->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $products->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\DnsHosting\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/dns-hostings', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\DnsHosting\Existing::class
        );
    }

    /**
     * Returns the details about single DNS Hosting product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\DnsHosting\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $product = $api->products->dnsHostings->getDetails(123456);
     *
     *      echo 'Product ID: ' . $product->id . PHP_EOL;
     *      echo 'Domain Name: ' . $product->domainName . PHP_EOL;
     *
     *      if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
     *          echo 'Product is registered' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $product_id): DataObject\Product\DnsHosting\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/dns-hostings/' . $product_id),
            DataObject\Product\DnsHosting\Existing::class
        );
    }

    /**
     * Returns the configuration for single DNS Hosting product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\DnsHosting\Configuration
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
     *      $configuration = $api->products->dnsHostings->getConfiguration(123456);
     *
     *      echo 'Is DNS management available: ' . ($configuration->isDnsManagementAvailable ? 'Yes' : 'No') . PHP_EOL;
     *      echo 'Name Servers: ' . implode(', ', $configuration->nameServers) . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getConfiguration(int $product_id): DataObject\Product\DnsHosting\Configuration
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/dns-hostings/' . $product_id . '/configuration'),
            DataObject\Product\DnsHosting\Configuration::class
        );
    }

    /**
     * Registers new DNS Hosting product.
     *
     * @param DataObject\Product\DnsHosting\Register $data_object
     *
     * @return DataObject\Product\DnsHosting\Existing
     * @throws AuthenticationException
     * @throws BadRequestException
     * @throws PaymentRequiredException
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
     * $new_product = DataObject\Product\DnsHosting\Register::build()
     *      ->setCustomerId(123456)
     *      ->setDomainName('crazydomains.com.au')
     *      ->setPlanId(60)
     *      ->setPeriod(12);
     *
     * try {
     *      $product = $api->products->dnsHostings->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\DnsHosting\Register $data_object
    ): DataObject\Product\DnsHosting\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/dns-hostings', $data_object->toRequestArray()),
            DataObject\Product\DnsHosting\Existing::class
        );
    }

    /**
     * Renews DNS Hosting product.
     *
     * @param int $product_id
     * @param DataObject\Product\DnsHosting\Renew|null $data_object
     *
     * @return DataObject\Product\DnsHosting\Existing
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws BadRequestException
     * @throws PaymentRequiredException
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
     * $renew_product = DataObject\Product\DnsHosting\Renew::build();
     * $renew_product->period = 24;
     *
     * try {
     *      $product = $api->products->dnsHostings->renew(123456, $renew_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function renew(
        int $product_id,
        DataObject\Product\DnsHosting\Renew $data_object = null
    ): DataObject\Product\DnsHosting\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/dns-hostings/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\DnsHosting\Existing::class
        );
    }

    /**
     * Terminates DNS Hosting product.
     *
     * @param int $product_id
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
     *      $api->products->dnsHostings->terminate(123456);
     *
     *      echo 'Product successfully terminated';
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function terminate(int $product_id): bool
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return $this->sendDeleteRequest('products/dns-hostings/' . $product_id);
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use InvalidArgumentException;

/**
 * SDK API for working with Servers products.
 *
 * @property-read Servers\Feature $features
 *
 * @title Servers Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Servers extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'features' => Servers\Feature::class,
    ];

    /**
     * Returns the list of existing Servers products.
     *
     * @param Filter\Product\Servers\GetAll|null $filters
     *
     * @return DataObject\Product\Servers\Existing[]|DataObject\Collection
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
     * $filters = Filter\Product\Servers\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->servers->getAll($filters);
     *
     *      foreach ($products as $product) {
     *          echo 'Product ID: ' . $product->id . PHP_EOL;
     *          echo 'Product Name: ' . $product->name . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $products->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $products->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $products->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\Servers\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/servers', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\Servers\Existing::class
        );
    }

    /**
     * Returns the details about single Servers product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\Servers\Existing
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
     *      $product = $api->products->servers->getDetails(123456);
     *
     *      echo 'Product ID: ' . $product->id . PHP_EOL;
     *      echo 'Product Name: ' . $product->name . PHP_EOL;
     *
     *      if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
     *          echo 'Product is registered' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $product_id): DataObject\Product\Servers\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/servers/' . $product_id),
            DataObject\Product\Servers\Existing::class
        );
    }

    /**
     * Creates a login link for Servers product.
     *
     * @param int $product_id
     * @param DataObject\Product\Servers\LoginLink\Create|null $data_object
     *
     * @return DataObject\Product\Servers\LoginLink\Existing
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $login_link = $api->products->servers->createLoginLink(123456);
     *
     *      echo 'Login link: ' . $login_link->link . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function createLoginLink(
        int $product_id,
        DataObject\Product\Servers\LoginLink\Create $data_object = null
    ): DataObject\Product\Servers\LoginLink\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/servers/' . $product_id . '/login-link',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\Servers\LoginLink\Existing::class
        );
    }

    /**
     * Registers new Servers product.
     *
     * @param DataObject\Product\Servers\Register $data_object
     *
     * @return DataObject\Product\Servers\Existing
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
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $new_product = DataObject\Product\Servers\Register::build()
     *      ->setCustomerId(123456)
     *      ->setPlanId(117)
     *      ->setPeriod(12)
     *      ->setLocation(PredefinedValue\Product\Servers::LOCATION_AU)
     *      ->setOperatingSystem('Ubuntu 20.04');
     *
     * // Add feature.
     * $new_product->features->add(DataObject\Product\Servers\Feature\Register::build()
     *      ->setType(PredefinedValue\Product\Servers\Feature::TYPE_HOSTING_MANAGER)
     *      ->setValue('cPanel')
     *      ->setPeriod(12)
     * );
     *
     * // Add multiple features.
     * $new_product->features->import([
     *      DataObject\Product\Servers\Feature\Register::build()
     *          ->setType(PredefinedValue\Product\Servers\Feature::TYPE_BANDWIDTH)
     *          ->setValue(9)
     *          ->setPeriod(12),
     *      DataObject\Product\Servers\Feature\Register::build()
     *          ->setType(PredefinedValue\Product\Servers\Feature::TYPE_CORE)
     *          ->setValue(4)
     *          ->setPeriod(12)
     * ]);
     *
     * try {
     *      $product = $api->products->servers->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\Servers\Register $data_object
    ): DataObject\Product\Servers\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/servers', $data_object->toRequestArray()),
            DataObject\Product\Servers\Existing::class
        );
    }

    /**
     * Renews Servers product.
     *
     * @param int $product_id
     * @param DataObject\Product\Servers\Renew|null $data_object
     *
     * @return DataObject\Product\Servers\Existing
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
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $renew_product = DataObject\Product\Servers\Renew::build();
     * $renew_product->period = 24;
     *
     * // Add multiple features.
     * $renew_product->features->import([
     *      DataObject\Product\Servers\Feature\Renew::build()
     *          ->setType(PredefinedValue\Product\Servers\Feature::TYPE_SSD)
     *          ->setPeriod(24),
     *      DataObject\Product\Servers\Feature\Renew::build()
     *          ->setType(PredefinedValue\Product\Servers\Feature::TYPE_RAM)
     *          ->setPeriod(24)
     * ]);
     *
     * try {
     *      $product = $api->products->servers->renew(123456, $renew_product);
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
        DataObject\Product\Servers\Renew $data_object = null
    ): DataObject\Product\Servers\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/servers/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\Servers\Existing::class
        );
    }

    /**
     * Terminates Servers product.
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
     *      $api->products->servers->terminate(123456);
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

        return $this->sendDeleteRequest('products/servers/' . $product_id);
    }
}

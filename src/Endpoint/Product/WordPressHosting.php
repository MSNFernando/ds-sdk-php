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
 * SDK API for working with WordPress Hosting products.
 *
 * @title WordPress Hosting Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class WordPressHosting extends AbstractEndpoint
{
    /**
     * Returns the list of existing WordPress Hosting products.
     *
     * @param Filter\Product\WordPressHosting\GetAll|null $filters
     *
     * @return DataObject\Product\WordPressHosting\Existing[]|DataObject\Collection
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
     * $filters = Filter\Product\WordPressHosting\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->wordpressHostings->getAll($filters);
     *
     *      foreach ($products as $product) {
     *          echo 'Product ID: ' . $product->id . PHP_EOL;
     *          echo 'Plan ID: ' . $product->planId . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $products->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $products->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $products->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\WordPressHosting\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/wordpress-hostings', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\WordPressHosting\Existing::class
        );
    }

    /**
     * Returns the details about single WordPress Hosting product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\WordPressHosting\Existing
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
     *      $product = $api->products->wordpressHostings->getDetails(123456);
     *
     *      echo 'Product ID: ' . $product->id . PHP_EOL;
     *      echo 'Plan ID: ' . $product->planId . PHP_EOL;
     *
     *      if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
     *          echo 'Product is registered' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $product_id): DataObject\Product\WordPressHosting\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/wordpress-hostings/' . $product_id),
            DataObject\Product\WordPressHosting\Existing::class
        );
    }

    /**
     * Registers new WordPress Hosting product.
     *
     * @param DataObject\Product\WordPressHosting\Register $data_object
     *
     * @return DataObject\Product\WordPressHosting\Existing
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
     * $new_product = DataObject\Product\WordPressHosting\Register::build()
     *      ->setCustomerId(123456)
     *      ->setPlanId(3848)
     *      ->setPeriod(12)
     *      ->setDomainName('crazydomains.com.au')
     *      ->setLocation(PredefinedValue\Product\WordPressHosting::LOCATION_AU);
     *
     * try {
     *      $product = $api->products->wordpressHostings->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\WordPressHosting\Register $data_object
    ): DataObject\Product\WordPressHosting\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/wordpress-hostings', $data_object->toRequestArray()),
            DataObject\Product\WordPressHosting\Existing::class
        );
    }

    /**
     * Renews WordPress Hosting product.
     *
     * @param int $product_id
     * @param DataObject\Product\WordPressHosting\Renew|null $data_object
     *
     * @return DataObject\Product\WordPressHosting\Existing
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
     * $renew_product = DataObject\Product\WordPressHosting\Renew::build();
     * $renew_product->period = 24;
     *
     * try {
     *      $product = $api->products->wordpressHostings->renew(123456, $renew_product);
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
        DataObject\Product\WordPressHosting\Renew $data_object = null
    ): DataObject\Product\WordPressHosting\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/wordpress-hostings/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\WordPressHosting\Existing::class
        );
    }

    /**
     * Terminates WordPress Hosting product.
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
     *      $api->products->wordpressHostings->terminate(123456);
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

        return $this->sendDeleteRequest('products/wordpress-hostings/' . $product_id);
    }
}

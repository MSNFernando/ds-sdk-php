<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use InvalidArgumentException;

/**
 * SDK API for working with Site Protection products.
 *
 * @title Site Protection Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class SiteProtection extends AbstractEndpoint
{
    /**
     * Returns the list of existing Site Protection products.
     *
     * @param Filter\Product\SiteProtection\GetAll|null $filters
     *
     * @return DataObject\Product\SiteProtection\Existing[]|DataObject\Collection
     * @throws InvalidArgumentException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $filters = Filter\Product\SiteProtection\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->siteProtections->getAll($filters);
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
    public function getAll(Filter\Product\SiteProtection\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/site-protections', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\SiteProtection\Existing::class
        );
    }

    /**
     * Returns the details about single Site Protection product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\SiteProtection\Existing
     * @throws InvalidArgumentException
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
     *      $product = $api->products->siteProtections->getDetails(123456);
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
    public function getDetails(int $product_id): DataObject\Product\SiteProtection\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/site-protections/' . $product_id),
            DataObject\Product\SiteProtection\Existing::class
        );
    }

    /**
     * Creates a login link for Site Protection product.
     *
     * @param int $product_id
     * @param DataObject\Product\SiteProtection\LoginLink\Create|null $data_object
     *
     * @return DataObject\Product\SiteProtection\LoginLink\Existing
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $login_link = $api->products->siteProtections->createLoginLink(123456);
     *
     *      echo 'Login link: ' . $login_link->link . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function createLoginLink(
        int $product_id,
        DataObject\Product\SiteProtection\LoginLink\Create $data_object = null
    ): DataObject\Product\SiteProtection\LoginLink\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/site-protections/' . $product_id . '/login-link',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\SiteProtection\LoginLink\Existing::class
        );
    }

    /**
     * Registers new Site Protection product.
     *
     * @param DataObject\Product\SiteProtection\Register $data_object
     *
     * @return DataObject\Product\SiteProtection\Existing
     * @throws InvalidArgumentException
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
     * $new_product = DataObject\Product\SiteProtection\Register::build()
     *      ->setCustomerId(123456)
     *      ->setDomainName('crazydomains.com.au')
     *      ->setPlanId(548)
     *      ->setPeriod(12);
     *
     * try {
     *      $product = $api->products->siteProtections->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\SiteProtection\Register $data_object
    ): DataObject\Product\SiteProtection\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/site-protections', $data_object->toRequestArray()),
            DataObject\Product\SiteProtection\Existing::class
        );
    }

    /**
     * Renews Site Protection product.
     *
     * @param int $product_id
     * @param DataObject\Product\SiteProtection\Renew|null $data_object
     *
     * @return DataObject\Product\SiteProtection\Existing
     * @throws InvalidArgumentException
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
     * $renew_product = DataObject\Product\SiteProtection\Renew::build();
     * $renew_product->period = 24;
     *
     * try {
     *      $product = $api->products->siteProtections->renew(123456, $renew_product);
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
        DataObject\Product\SiteProtection\Renew $data_object = null
    ): DataObject\Product\SiteProtection\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/site-protections/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\SiteProtection\Existing::class
        );
    }

    /**
     * Terminates Site Protection product.
     *
     * @param int $product_id
     *
     * @return bool
     * @throws InvalidArgumentException
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
     *      $api->products->siteProtections->terminate(123456);
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

        return $this->sendDeleteRequest('products/site-protections/' . $product_id);
    }
}

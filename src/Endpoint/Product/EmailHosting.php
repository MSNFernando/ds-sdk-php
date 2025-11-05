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
 * SDK API for working with Email Hosting products.
 *
 * @title Email Hosting Product API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class EmailHosting extends AbstractEndpoint
{
    /**
     * Returns the list of existing Email Hosting products.
     *
     * @param Filter\Product\EmailHosting\GetAll|null $filters
     *
     * @return DataObject\Product\EmailHosting\Existing[]|DataObject\Collection
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
     * $filters = Filter\Product\EmailHosting\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $products = $api->products->emailHostings->getAll($filters);
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
    public function getAll(Filter\Product\EmailHosting\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/email-hostings', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\EmailHosting\Existing::class
        );
    }

    /**
     * Returns the details about single Email Hosting product.
     *
     * @param int $product_id
     *
     * @return DataObject\Product\EmailHosting\Existing
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
     *      $product = $api->products->emailHostings->getDetails(123456);
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
    public function getDetails(int $product_id): DataObject\Product\EmailHosting\Existing
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/email-hostings/' . $product_id),
            DataObject\Product\EmailHosting\Existing::class
        );
    }

    /**
     * Creates a login link for Email Hosting product.
     *
     * @param int $product_id
     * @param DataObject\Product\EmailHosting\LoginLink\Create|null $data_object
     *
     * @return DataObject\Product\EmailHosting\LoginLink\Existing
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $login_link = $api->products->emailHostings->createLoginLink(123456);
     *
     *      echo 'Login link: ' . $login_link->link . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function createLoginLink(
        int $product_id,
        DataObject\Product\EmailHosting\LoginLink\Create $data_object = null
    ): DataObject\Product\EmailHosting\LoginLink\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/email-hostings/' . $product_id . '/login-link',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\EmailHosting\LoginLink\Existing::class
        );
    }

    /**
     * Registers new Email Hosting product.
     *
     * @param DataObject\Product\EmailHosting\Register $data_object
     *
     * @return DataObject\Product\EmailHosting\Existing
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
     * $new_product = DataObject\Product\EmailHosting\Register::build()
     *      ->setCustomerId(123456)
     *      ->setDomainName('crazydomains.com.au')
     *      ->setPlanId(47)
     *      ->setPeriod(12);
     *
     * try {
     *      $product = $api->products->emailHostings->register($new_product);
     *
     *      echo 'Product ID: ' . $product->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        DataObject\Product\EmailHosting\Register $data_object
    ): DataObject\Product\EmailHosting\Existing {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/email-hostings', $data_object->toRequestArray()),
            DataObject\Product\EmailHosting\Existing::class
        );
    }

    /**
     * Renews Email Hosting product.
     *
     * @param int $product_id
     * @param DataObject\Product\EmailHosting\Renew|null $data_object
     *
     * @return DataObject\Product\EmailHosting\Existing
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
     * $renew_product = DataObject\Product\EmailHosting\Renew::build();
     * $renew_product->period = 24;
     *
     * try {
     *      $product = $api->products->emailHostings->renew(123456, $renew_product);
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
        DataObject\Product\EmailHosting\Renew $data_object = null
    ): DataObject\Product\EmailHosting\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'products/email-hostings/' . $product_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Product\EmailHosting\Existing::class
        );
    }

    /**
     * Terminates Email Hosting product.
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
     *      $api->products->emailHostings->terminate(123456);
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

        return $this->sendDeleteRequest('products/email-hostings/' . $product_id);
    }
}

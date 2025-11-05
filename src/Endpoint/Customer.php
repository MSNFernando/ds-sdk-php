<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use InvalidArgumentException;

/**
 * Methods to handle customers.
 *
 * @title Customer API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Customer extends AbstractEndpoint
{
    /**
     * Returns the list of customers.
     *
     * @param Filter\Customer\GetAll|null $filters
     *
     * @return DataObject\Customer\Existing[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Filter;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $filters = Filter\Customer\GetAll::build();
     * $filters->page = 1;
     * $filters->limit = 10;
     *
     * try {
     *      $customers = $api->customers->getAll($filters);
     *
     *      foreach ($customers as $customer) {
     *          echo 'Customer ID: ' . $customer->id . PHP_EOL;
     *          echo 'First Name: ' . $customer->firstName . PHP_EOL;
     *          echo 'Last Name: ' . $customer->lastName . PHP_EOL;
     *
     *          if ($customer->statusId === PredefinedValue\Customer::STATUS_ACTIVE) {
     *              echo 'Customer is active' . PHP_EOL;
     *          }
     *      }
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Customer\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('customers', $filters ? $filters->toRequestArray() : []),
            DataObject\Customer\Existing::class
        );
    }

    /**
     * Returns the details of a single customer.
     *
     * @param int $customer_id
     *
     * @return DataObject\Customer\Existing
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
     *      $customer = $api->customers->getDetails(123456);
     *
     *      echo 'Customer ID: ' . $customer->id . PHP_EOL;
     *      echo 'First Name: ' . $customer->firstName . PHP_EOL;
     *      echo 'Last Name: ' . $customer->lastName . PHP_EOL;
     *
     *      if ($customer->statusId === PredefinedValue\Customer::STATUS_ACTIVE) {
     *          echo 'Customer is active' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $customer_id): DataObject\Customer\Existing
    {
        if ($customer_id < 1) {
            throw new InvalidArgumentException('The argument $customer_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('customers/' . $customer_id),
            DataObject\Customer\Existing::class
        );
    }

    /**
     * Creates a login link for a customer.
     *
     * @param int $customer_id
     * @param DataObject\Customer\LoginLink\Create|null $data_object
     *
     * @return DataObject\Customer\LoginLink\Existing
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
     *      $login_link = $api->customers->createLoginLink(123456);
     *
     *      echo 'Login link: ' . $login_link->link . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function createLoginLink(
        int $customer_id,
        DataObject\Customer\LoginLink\Create $data_object = null
    ): DataObject\Customer\LoginLink\Existing {
        if ($customer_id < 1) {
            throw new InvalidArgumentException('The argument $customer_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'customers/' . $customer_id . '/login-link',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Customer\LoginLink\Existing::class
        );
    }

    /**
     * Creates new customer.
     *
     * @param DataObject\Customer\Create $data_object
     *
     * @return DataObject\Customer\Existing
     * @throws AuthenticationException
     * @throws BadRequestException
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
     * try {
     *      $new_customer = DataObject\Customer\Create::build()
     *          ->setFirstName('John')
     *          ->setLastName('Doe')
     *          ->setAddress('123 Example Street')
     *          ->setCity('Testville')
     *          ->setCountry('AU')
     *          ->setState('WA')
     *          ->setPostCode('00000')
     *          ->setCountryCode(61)
     *          ->setPhone('912345678')
     *          ->setMobile('912345678')
     *          ->setEmail('john.doe@crazydomains.com.au')
     *          ->setAccountType(PredefinedValue\Customer::ACCOUNT_TYPE_BUSINESS)
     *          ->setBusinessName('John & Doe Corp')
     *          ->setBusinessNumberType('ABN')
     *          ->setBusinessNumber('12345678');
     *
     *      $new_customer->username = 'john_doe';
     *      $new_customer->password = 'NWx9673z9gptzVJN';
     *
     *      $customer = $api->customers->create($new_customer);
     *
     *      echo 'Customer ID: ' . $customer->id . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function create(DataObject\Customer\Create $data_object): DataObject\Customer\Existing
    {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('customers', $data_object->toRequestArray()),
            DataObject\Customer\Existing::class
        );
    }

    /**
     * Updates the details of a single customer.
     *
     * @param int $customer_id
     * @param DataObject\Customer\Update $data_object
     *
     * @return DataObject\Customer\Existing
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
     * try {
     *      $update_customer = DataObject\Customer\Update::build();
     *      $update_customer->firstName = 'John';
     *      $update_customer->lastName = 'Doe';
     *      $update_customer->username = 'john_doe_2';
     *
     *      $customer = $api->customers->update(123456, $update_customer);
     *
     *      echo 'Customer ID: ' . $customer->id . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function update(int $customer_id, DataObject\Customer\Update $data_object): DataObject\Customer\Existing
    {
        if ($customer_id < 1) {
            throw new InvalidArgumentException('The argument $customer_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPatchRequest('customers/' . $customer_id, $data_object->toRequestArray()),
            DataObject\Customer\Existing::class
        );
    }

    /**
     * Terminates the customer.
     *
     * @param int $customer_id
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
     *      $api->customers->terminate(123456);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function terminate(int $customer_id): bool
    {
        if ($customer_id < 1) {
            throw new InvalidArgumentException('The argument $customer_id must be positive integer');
        }

        return $this->sendDeleteRequest('customers/' . $customer_id);
    }
}

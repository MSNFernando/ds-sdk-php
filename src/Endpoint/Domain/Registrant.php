<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Domain;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\DataObject\Helper;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use InvalidArgumentException;

/**
 * SDK API for working with domain registrants.
 *
 * @title Domain Registrant API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Registrant extends AbstractEndpoint
{
    /**
     * Returns the list of registrants.
     *
     * @param Filter\Domain\Registrant\GetAll|null $filters
     *
     * @return DataObject\Domain\Registrant\Existing[]|DataObject\Collection
     * @throws AuthenticationException
     * @throws BadRequestException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\Filter;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $filters = Filter\Domain\Registrant\GetAll::build();
     * $filters->page = 1;
     * $filters->limit = 10;
     *
     * $registrants = $api->domains->registrants->getAll($filters);
     *
     * try {
     *      foreach ($registrants as $registrant) {
     *          echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
     *          echo 'First Name: ' . $registrant->firstName . PHP_EOL;
     *          echo 'Last Name: ' . $registrant->lastName . PHP_EOL;
     *
     *          if ($registrant->accountType === PredefinedValue\Domain\Registrant::ACCOUNT_TYPE_BUSINESS) {
     *              echo 'Business Name: ' . $registrant->businessName . PHP_EOL;
     *          }
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getAll(Filter\Domain\Registrant\GetAll $filters = null): DataObject\Collection
    {
        return Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('/domains/registrants', $filters ? $filters->toRequestArray() : []),
            DataObject\Domain\Registrant\Existing::class
        );
    }

    /**
     * Returns the details about single registrant.
     *
     * @param int $registrant_id
     *
     * @return DataObject\Domain\Registrant\Existing
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
     *      $registrant = $api->domains->registrants->getDetails(123456);
     *
     *      echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
     *      echo 'First Name: ' . $registrant->firstName . PHP_EOL;
     *      echo 'Last Name: ' . $registrant->lastName . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $registrant_id): DataObject\Domain\Registrant\Existing
    {
        if ($registrant_id < 1) {
            throw new InvalidArgumentException('The argument $registrant_id must be positive integer');
        }

        return Helper::convertResponseToDataObject(
            $this->sendGetRequest('/domains/registrants/' . $registrant_id),
            DataObject\Domain\Registrant\Existing::class
        );
    }

    /**
     * Creates new registrant.
     *
     * @param DataObject\Domain\Registrant\Create $data_object
     *
     * @return DataObject\Domain\Registrant\Existing
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
     *      $new_registrant = DataObject\Domain\Registrant\Create::build()
     *          ->setFirstName('John')
     *          ->setLastName('Doe')
     *          ->setAddress('123 Example Street')
     *          ->setCity('Testville')
     *          ->setCountry('AU')
     *          ->setState('WA')
     *          ->setPostCode('00000')
     *          ->setCountryCode(61)
     *          ->setPhone('912345678')
     *          ->setEmail('john.doe@crazydomains.com.au')
     *          ->setAccountType(PredefinedValue\Domain\Registrant::ACCOUNT_TYPE_BUSINESS)
     *          ->setBusinessName('John & Doe Corp')
     *          ->setBusinessNumberType('ABN')
     *          ->setBusinessNumber('12345678');
     *      $registrant = $api->domains->registrants->create($new_registrant);
     *
     *      echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function create(DataObject\Domain\Registrant\Create $data_object): DataObject\Domain\Registrant\Existing
    {
        return Helper::convertResponseToDataObject(
            $this->sendPostRequest('/domains/registrants', $data_object->toRequestArray()),
            DataObject\Domain\Registrant\Existing::class
        );
    }

    /**
     * Updates the details of the single registrant.
     *
     * @param int $registrant_id
     * @param DataObject\Domain\Registrant\Update $data_object
     *
     * @return DataObject\Domain\Registrant\Existing
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
     *      $update_registrant = DataObject\Domain\Registrant\Update::build();
     *      $update_registrant->firstName = 'John';
     *      $update_registrant->lastName = 'Doe';
     *
     *      $registrant = $api->domains->registrants->update(123456, $update_registrant);
     *
     *      echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function update(
        int $registrant_id,
        DataObject\Domain\Registrant\Update $data_object
    ): DataObject\Domain\Registrant\Existing {
        if ($registrant_id < 1) {
            throw new InvalidArgumentException('The argument $registrant_id must be positive integer');
        }

        return Helper::convertResponseToDataObject(
            $this->sendPatchRequest('/domains/registrants/' . $registrant_id, $data_object->toRequestArray()),
            DataObject\Domain\Registrant\Existing::class
        );
    }
}

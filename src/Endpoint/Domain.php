<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\Domain\DNS as DNSEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Domain\Host as HostEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Domain\Registrant as RegistrantEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Domain\Transfer as TransferEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;
use InvalidArgumentException;

/**
 * SDK API for working with domains.
 *
 * @property-read DNSEndpoint $dns
 * @property-read HostEndpoint $hosts
 * @property-read RegistrantEndpoint $registrants
 * @property-read TransferEndpoint $transfers
 *
 * @title Domain API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Domain extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'dns' => DNSEndpoint::class,
        'hosts' => HostEndpoint::class,
        'registrants' => RegistrantEndpoint::class,
        'transfers' => TransferEndpoint::class,
    ];

    /**
     * Returns the list of available TLDs with prices.
     *
     * @param Filter\Domain\AvailableTlds|null $filters
     *
     * @return DataObject\Domain\Tld[]|DataObject\Collection
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
     * $filters = Filter\Domain\AvailableTlds::build();
     * $filters->customerId = 123456;
     * $filters->currency = 'AUD';
     * $filters->tlds = [ 'com.au', 'net.au' ];
     * $filters->page = 1;
     * $filters->limit = 10;
     *
     * try {
     *      $tlds = $api->domains->getAvailableTlds($filters);
     *
     *      foreach ($tlds as $tld) {
     *          echo 'TLD: ' . $tld->tld . PHP_EOL;
     *          echo 'Minimal period: ' . $tld->minPeriod . PHP_EOL;
     *          echo 'Register price: ' . $tld->price->register . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $tlds->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $tlds->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $tlds->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAvailableTlds(Filter\Domain\AvailableTlds $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('domains/tlds', $filters ? $filters->toRequestArray() : []),
            DataObject\Domain\Tld::class
        );
    }

    /**
     * Checks the availability of domain names.
     *
     * @param string[] $domain_names
     * @param Filter\Domain\CheckAvailability|null $filters
     *
     * @return DataObject\Domain\AvailabilityResult[]|DataObject\Collection
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
     * $filters = Filter\Domain\CheckAvailability::build();
     * $filters->customerId = 123456;
     * $filters->currency = 'AUD';
     *
     * $domain_names = [ 'crazydomains.com.au', 'vodien.com.au' ];
     *
     * try {
     *      $availability_results = $api->domains->checkAvailability($domain_names, $filters);
     *
     *      foreach ($availability_results as $availability_result) {
     *          echo 'Domain name:' . $availability_result->domainName . PHP_EOL;
     *          echo 'Available: ' . ($availability_result->isAvailable ? 'yes' : 'no') . PHP_EOL;
     *      }
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function checkAvailability(
        array $domain_names,
        Filter\Domain\CheckAvailability $filters = null
    ): DataObject\Collection {
        if (empty($domain_names)) {
            throw new InvalidArgumentException('The argument $domain_names must be not empty array');
        }

        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest(
                'domains/availability',
                compact('domain_names') + ($filters ? $filters->toRequestArray() : [])
            ),
            DataObject\Domain\AvailabilityResult::class
        );
    }

    /**
     * Returns the list of existing domain names.
     *
     * @param Filter\Domain\GetAll|null $filters
     *
     * @return DataObject\Domain\Existing[]|DataObject\Collection
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
     * $filters = Filter\Domain\GetAll::build();
     *
     * $filters->customerId = 123456;
     * $filters->statusId = 1;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $domains = $api->domains->getAll($filters);
     *
     *      foreach ($domains as $domain) {
     *          echo 'Domain ID: ' . $domain->id . PHP_EOL;
     *          echo 'Domain Name: ' . $domain->domainName . PHP_EOL;
     *          echo 'Name servers:' . PHP_EOL;
     *
     *          if ($domain->statusId === PredefinedValue\Domain::STATUS_REGISTERED) {
     *              echo 'Domain name is registered' . PHP_EOL;
     *          }
     *
     *          foreach ($domain->nameServers as $i => $nameServer) {
     *              echo 'NS #' . $i . ' Host: ' . $nameServer->host . PHP_EOL;
     *              echo 'NS #' . $i . ' IP: ' . $nameServer->ip . PHP_EOL;
     *          }
     *      }
     *
     *      echo 'Total items: ' . $domains->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $domains->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $domains->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Domain\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('domains', $filters ? $filters->toRequestArray() : []),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Returns the details about single domain name.
     *
     * @param int $domain_id
     *
     * @return DataObject\Domain\Existing
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
     *      $domain = $api->domains->getDetails(123456);
     *
     *      echo 'Domain ID: ' . $domain->id . PHP_EOL;
     *      echo 'Domain Name: ' . $domain->domainName . PHP_EOL;
     *
     *      if ($domain->statusId === PredefinedValue\Domain::STATUS_REGISTERED) {
     *          echo 'Domain name is registered' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $domain_id): DataObject\Domain\Existing
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('domains/' . $domain_id),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Registers new domain name.
     *
     * @param DataObject\Domain\Register $data_object
     *
     * @return DataObject\Domain\Existing
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
     * $new_domain = DataObject\Domain\Register::build();
     *
     * $new_domain->setDomainName('crazydomains.com.au')
     *     ->setCustomerId(123456);
     *
     * // Add nameserver.
     * $new_domain->nameServers->add(
     *      DataObject\Domain\NameServer\Create::build([
     *          'host' => 'ns1.secureparkme.com',
     *  ]));
     *
     * // Add multiple nameservers.
     * $new_domain->nameServers->import([
     *      DataObject\Domain\NameServer\Create::build()->setHost('ns2.secureparkme.com'),
     *      DataObject\Domain\NameServer\Create::build()->setHost('ns3.secureparkme.com'),
     * ]);
     *
     * // Set eligibility details. The format is the same as in the documentation to REST API methods.
     * $new_domain->eligibility = [
     *      [ 'name' => 'business_type', 'value' => 'Other' ],
     *      [ 'name' => 'business_name', 'value' => 'Crazy Domains' ],
     *      [ 'name' => 'business_number_type', 'value' => 'ABN' ],
     *      [ 'name' => 'business_number', 'value' => '95851604390' ],
     * ];
     *
     * try {
     *      $domain = $api->domains->register($new_domain);
     *
     *      echo 'Domain ID: ' . $domain->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(DataObject\Domain\Register $data_object): DataObject\Domain\Existing
    {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('domains', $data_object->toRequestArray()),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Updates the details for a single domain name.
     *
     * @param int $domain_id
     * @param DataObject\Domain\Update $data_object
     *
     * @return DataObject\Domain\Existing
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
     * $domain_update = DataObject\Domain\Update::build();
     *
     * $domain_update->nameServers = DataObject\Collection::build(DataObject\Domain\NameServer\Create::class)
     *      ->add(DataObject\Domain\NameServer\Create::build()->setHost('ns1.secureparkme.com'))
     *      ->add(DataObject\Domain\NameServer\Create::build()->setHost('ns2.secureparkme.com'));
     *
     * $domain_update->setIsLocked(true);
     *
     * try {
     *      // Returns the data-object of updated domain.
     *      $domain = $api->domains->update(123456, $domain_update);
     *
     *      echo 'Domain ID: ' . $domain->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function update(int $domain_id, DataObject\Domain\Update $data_object): DataObject\Domain\Existing
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPatchRequest('domains/' . $domain_id, $data_object->toRequestArray()),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Renews domain name.
     *
     * @param int $domain_id
     * @param DataObject\Domain\Renew|null $data_object
     *
     * @return DataObject\Domain\Existing
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
     * $renew_domain = DataObject\Domain\Renew::build();
     * $renew_domain->period = 24;
     *
     * try {
     *      $domain = $api->domains->renew(123456, $renew_domain);
     *
     *      echo 'Domain ID: ' . $domain->id;
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function renew(int $domain_id, DataObject\Domain\Renew $data_object = null): DataObject\Domain\Existing
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest(
                'domains/' . $domain_id . '/renewal',
                $data_object ? $data_object->toRequestArray() : []
            ),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Terminates domain name.
     *
     * @param int $domain_id
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
     *      $api->domains->terminate(123456);
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function terminate(int $domain_id): bool
    {
        if ($domain_id < 1) {
            throw new InvalidArgumentException('The argument $domain_id must be positive integer');
        }

        return $this->sendDeleteRequest('domains/' . $domain_id);
    }
}

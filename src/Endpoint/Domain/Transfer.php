<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Domain;

use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\DataObject\Helper;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Exception\PaymentRequiredException;

/**
 * SDK API for working with domain transfers.
 *
 * @title Domain Transfer API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Transfer extends AbstractEndpoint
{
    /**
     * Checks the availability of transfer.
     *
     * @param DataObject\Domain\Transfer\Availability $data_object
     *
     * @return DataObject\Domain\Transfer\AvailabilityResult
     * @throws AuthenticationException
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
     * $check_availability = DataObject\Domain\Transfer\Availability::build();
     * $check_availability->domainName = 'crazydomains.com.au';
     * $check_availability->authKey = 'UT%E623trvui2376!';
     *
     * try {
     *      $transfer_availability = $api->domains->transfers->checkAvailability($check_availability);
     *
     *      echo 'Is available: ' . ($transfer_availability->isAvailable ?  'Yes' : 'No') . PHP_EOL;
     *      echo 'Is eligible for renewal: '
     *          . ($transfer_availability->isEligibleForRenewal ?  'Yes' : 'No') . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function checkAvailability(
        DataObject\Domain\Transfer\Availability $data_object
    ): DataObject\Domain\Transfer\AvailabilityResult {
        return Helper::convertResponseToDataObject(
            $this->sendGetRequest('/domains/transfers/availability', $data_object->toRequestArray()),
            DataObject\Domain\Transfer\AvailabilityResult::class
        );
    }

    /**
     * Creates transfer request.
     *
     * @param DataObject\Domain\Transfer\Start $data_object
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
     * $start_transfer = DataObject\Domain\Transfer\Start::build();
     * $start_transfer->customerId = 123456;
     * $start_transfer->domainName = 'crazydomains.com.au';
     * $start_transfer->authKey = 'UT%E623trvui2376!';
     * $start_transfer->period = 24;
     *
     * try {
     *      $domain = $api->domains->transfers->start($start_transfer);
     *
     *      echo 'Domain ID: ' . $domain->id . PHP_EOL;
     *      echo 'Domain status: ' . $domain->statusId . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function start(DataObject\Domain\Transfer\Start $data_object): DataObject\Domain\Existing
    {
        return Helper::convertResponseToDataObject(
            $this->sendPostRequest('/domains/transfers', $data_object->toRequestArray()),
            DataObject\Domain\Existing::class
        );
    }

    /**
     * Cancels transfer request.
     *
     * @param DataObject\Domain\Transfer\Cancel $data_object
     *
     * @return bool
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
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * $cancel_transfer = DataObject\Domain\Transfer\Cancel::build();
     * $cancel_transfer->domainId = 123456;
     * $cancel_transfer->authKey = 'UT%E623trvui2376!';
     * $cancel_transfer->type = PredefinedValue\Domain::TRANSFER_TYPE_IN;
     *
     * try {
     *      $api->domains->transfers->cancel($cancel_transfer);
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function cancel(DataObject\Domain\Transfer\Cancel $data_object): bool
    {
        return $this->sendDeleteRequest('/domains/transfers', $data_object->toRequestArray());
    }
}

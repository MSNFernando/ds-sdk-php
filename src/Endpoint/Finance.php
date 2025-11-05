<?php

namespace Dreamscape\ResellerApiSdk\Endpoint;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Endpoint\Finance\Invoice as InvoiceEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;

/**
 * API for finances.
 *
 * @property-read InvoiceEndpoint $invoices
 *
 * @title Finance API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Finance extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'invoices' => InvoiceEndpoint::class,
    ];

    /**
     * Returns the balance details.
     *
     * @return DataObject\Finance\Balance
     * @throws AuthenticationException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     * $balance_details = $api->finances->getBalance();
     *
     * echo 'Balance: ' . $balance_details->balance . PHP_EOL;
     * echo 'Currency: ' . $balance_details->currency . PHP_EOL;
     */
    public function getBalance(): DataObject\Finance\Balance
    {
        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('finances/balance'),
            DataObject\Finance\Balance::class
        );
    }

    /**
     * Returns the list of currencies.
     *
     * @return DataObject\Collection|DataObject\Finance\Currency[]
     * @throws AuthenticationException
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     * $currencies = $api->finances->getCurrenciesList();
     *
     * foreach ($currencies as $currency) {
     *      echo $currency->name . ' (' . $currency->code . ')' . PHP_EOL;
     * }
     */
    public function getCurrenciesList(): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('finances/currencies'),
            DataObject\Finance\Currency::class
        );
    }
}

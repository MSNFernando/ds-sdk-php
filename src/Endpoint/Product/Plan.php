<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception\NotFoundException;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use InvalidArgumentException;

/**
 * SDK API for working with product plans.
 *
 * @property-read Plan\Feature $features
 *
 * @title Product Plan API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Plan extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'features' => Plan\Feature::class,
    ];

    /**
     * Returns the list of existing product plans.
     *
     * @param Filter\Product\Plan\GetAll|null $filters
     *
     * @return DataObject\Product\Plan\Existing[]|DataObject\Collection
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
     * $filters = Filter\Product\Plan\GetAll::build();
     *
     * $filters->typeId = 11;
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $plans = $api->products->plans->getAll($filters);
     *
     *      foreach ($plans as $plan) {
     *          echo 'ID: ' . $plan->id . PHP_EOL;
     *          echo 'Name: ' . $plan->name . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $plans->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $plans->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $plans->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\Plan\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/plans', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\Plan\Existing::class
        );
    }

    /**
     * Returns the details about single product plan.
     *
     * @param int $plan_id
     *
     * @return DataObject\Product\Plan\Existing
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
     *      $plan = $api->products->plans->getDetails(2595);
     *
     *      echo 'Plan ID: ' . $plan->id . PHP_EOL;
     *      echo 'Type ID: ' . $plan->typeId . PHP_EOL;
     *      echo 'Name: ' . $plan->name . PHP_EOL;
     *      echo 'Periods: ' . PHP_EOL;
     *
     *      foreach ($plan->periods as $period) {
     *          echo '  Period: ' . $period->period . PHP_EOL;
     *          echo '  Is FREE trial: ' . ($period->isFreeTrial ? 'yes' : 'no') . PHP_EOL;
     *          echo '  Is renewable: ' . ($period->isRenewable ? 'yes' : 'no') . PHP_EOL;
     *          echo '  Expires: ' . ($period->expires ? 'yes' : 'no') . PHP_EOL;
     *          echo '  Register price: ' . $period->price->register . PHP_EOL;
     *          echo '  Renew price: ' . $period->price->renew . PHP_EOL;
     *          echo '  =======' . PHP_EOL;
     *      }
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function getDetails(int $plan_id): DataObject\Product\Plan\Existing
    {
        if ($plan_id < 1) {
            throw new InvalidArgumentException('The argument $plan_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendGetRequest('products/plans/' . $plan_id),
            DataObject\Product\Plan\Existing::class
        );
    }
}

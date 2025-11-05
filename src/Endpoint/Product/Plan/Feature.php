<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product\Plan;

use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use InvalidArgumentException;

/**
 * SDK API for working with product plan features.
 *
 * @title Product Plan Feature API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Feature extends AbstractEndpoint
{
    /**
     * Returns the list of existing product plan features.
     *
     * @param Filter\Product\Plan\Feature\GetAll|null $filters
     *
     * @return DataObject\Product\Plan\Feature[]|DataObject\Collection
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
     * $filters = Filter\Product\Plan\Feature\GetAll::build();
     * $filters->types = [ 'core', 'hosting_manager' ];
     *
     * try {
     *      $features = $api->products->plans->features->getAll(117, $filters);
     *
     *      foreach ($features as $feature) {
     *          echo 'Type: ' . $feature->type . PHP_EOL;
     *          echo 'Values:' . PHP_EOL;
     *
     *          foreach ($feature->values as $value) {
     *              echo '  Value: ' . $value->value . PHP_EOL;
     *              echo '  Periods: ' . PHP_EOL;
     *
     *              foreach ($value->periods as $period) {
     *                  echo '    Period: ' . $period->period . PHP_EOL;
     *                  echo '    Wholesale price: ' . $period->price->wholesale . PHP_EOL;
     *                  echo '    Registration price: ' . $period->price->register . PHP_EOL;
     *                  echo '    Renewal price: ' . $period->price->renew . PHP_EOL;
     *              }
     *          }
     *      }
     * } catch (Exception\BadRequestException $e) {
     * // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(int $plan_id, Filter\Product\Plan\Feature\GetAll $filters = null): DataObject\Collection
    {
        if ($plan_id < 1) {
            throw new InvalidArgumentException('The argument $plan_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest(
                'products/plans/' . $plan_id . '/features',
                $filters ? $filters->toRequestArray() : []
            ),
            DataObject\Product\Plan\Feature::class
        );
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product;

use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Exception\AuthenticationException;
use Dreamscape\ResellerApiSdk\Exception\BadRequestException;

/**
 * SDK API for working with product types.
 *
 * @title Product Type API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Type extends AbstractEndpoint
{
    /**
     * Returns the list of existing product types.
     *
     * @param Filter\Product\Type\GetAll|null $filters
     *
     * @return DataObject\Product\Type\Existing[]|DataObject\Collection
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
     * $filters = Filter\Product\Type\GetAll::build();
     *
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $types = $api->products->types->getAll($filters);
     *
     *      foreach ($types as $type) {
     *          echo 'Type ID: ' . $type->id . PHP_EOL;
     *          echo 'Name: ' . $type->name . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $types->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $types->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $types->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(Filter\Product\Type\GetAll $filters = null): DataObject\Collection
    {
        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest('products/types', $filters ? $filters->toRequestArray() : []),
            DataObject\Product\Type\Existing::class
        );
    }
}

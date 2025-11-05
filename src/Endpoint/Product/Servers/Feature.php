<?php

namespace Dreamscape\ResellerApiSdk\Endpoint\Product\Servers;

use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Filter;
use InvalidArgumentException;

/**
 * SDK API for working with Servers product features.
 *
 * @title Servers Product Features API
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Feature extends AbstractEndpoint
{
    /**
     * Returns the list of existing Servers product features.
     *
     * @param Filter\Product\Servers\Feature\GetAll|null $filters
     *
     * @return DataObject\Product\Servers\Feature\Existing[]|DataObject\Collection
     * @throws InvalidArgumentException
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
     * $filters = Filter\Product\Servers\Feature\GetAll::build();
     * $filters->limit = 10;
     * $filters->page = 1;
     *
     * try {
     *      $features = $api->products->servers->features->getAll(123456, $filters);
     *
     *      foreach ($features as $feature) {
     *          echo 'Feature ID: ' . $feature->id . PHP_EOL;
     *          echo 'Type: ' . $feature->type . PHP_EOL;
     *          echo 'Value: ' . $feature->value . PHP_EOL;
     *          echo '=========' . PHP_EOL;
     *      }
     *
     *      echo 'Total items: ' . $features->totalItems . PHP_EOL;
     *      echo 'Total pages: ' . $features->totalPages . PHP_EOL;
     *      echo 'Current page: ' . $features->currentPage . PHP_EOL;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * }
     */
    public function getAll(
        int $product_id,
        Filter\Product\Servers\Feature\GetAll $filters = null
    ): DataObject\Collection {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObjectCollection(
            $this->sendGetRequest(
                'products/servers/' . $product_id . '/features',
                $filters ? $filters->toRequestArray() : []
            ),
            DataObject\Product\Servers\Feature\Existing::class
        );
    }

    /**
     * Create new Servers product feature.
     *
     * @param int $product_id
     * @param DataObject\Product\Servers\Feature\Register $data_object
     *
     * @return DataObject\Product\Servers\Feature\Existing
     *
     * @example
     * use Dreamscape\ResellerApiSdk\Api;
     * use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
     * use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
     * use Dreamscape\ResellerApiSdk\DataObject;
     * use Dreamscape\ResellerApiSdk\PredefinedValue;
     * use Dreamscape\ResellerApiSdk\Exception;
     *
     * $api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
     *
     * try {
     *      $new_feature = DataObject\Product\Servers\Feature\Register::build()
     *          ->setType(PredefinedValue\Product\Servers\Feature::TYPE_SSD)
     *          ->setValue(50_000)
     *          ->setPeriod(12);
     *      $feature = $api->products->servers->features->register(123456, $new_feature);
     *
     *      echo 'Feature ID: ' . $feature->id;
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\PaymentRequiredException $e) {
     *      // Handle the exception.
     * }
     */
    public function register(
        int $product_id,
        DataObject\Product\Servers\Feature\Register $data_object
    ): DataObject\Product\Servers\Feature\Existing {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        return DataObject\Helper::convertResponseToDataObject(
            $this->sendPostRequest('products/servers/' . $product_id . '/features/', $data_object->toRequestArray()),
            DataObject\Product\Servers\Feature\Existing::class
        );
    }

    /**
     * Terminates Servers product feature.
     *
     * @param int $product_id
     * @param int $feature_id
     *
     * @return bool
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
     *      $api->products->servers->features->terminate(123456, 123456);
     *
     *      echo 'Feature successfully terminated';
     * } catch (Exception\BadRequestException $e) {
     *      // Handle the errors in $e->getErrors().
     * } catch (Exception\NotFoundException $e) {
     *      // Handle the exception.
     * }
     */
    public function terminate(int $product_id, int $feature_id): bool
    {
        if ($product_id < 1) {
            throw new InvalidArgumentException('The argument $product_id must be positive integer');
        }

        if ($feature_id < 1) {
            throw new InvalidArgumentException('The argument $feature_id must be positive integer');
        }

        return $this->sendDeleteRequest('products/servers/' . $product_id . '/features/' . $feature_id);
    }
}

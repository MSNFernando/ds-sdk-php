<?php

namespace Dreamscape\ResellerApiSdk;

use Dreamscape\ResellerApiSdk\Endpoint\AbstractEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Customer as CustomerEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Domain as DomainEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Product as ProductEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Finance as FinanceEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Reseller as ResellerEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Dictionary as DictionaryEndpoint;
use Dreamscape\ResellerApiSdk\Endpoint\Service as ServiceEndpoint;

/**
 * API client for the Reseller REST API.
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 *
 * @property-read CustomerEndpoint $customers
 * @property-read DomainEndpoint $domains
 * @property-read ProductEndpoint $products
 * @property-read FinanceEndpoint $finances
 * @property-read ResellerEndpoint $reseller
 * @property-read DictionaryEndpoint $dictionary
 * @property-read ServiceEndpoint $service
 */
final class Api extends AbstractEndpoint
{
    /**
     * @inheritDoc
     */
    protected array $endpoint_to_class_map = [
        'customers' => CustomerEndpoint::class,
        'domains' => DomainEndpoint::class,
        'products' => ProductEndpoint::class,
        'finances' => FinanceEndpoint::class,
        'reseller' => ResellerEndpoint::class,
        'dictionary' => DictionaryEndpoint::class,
        'service' => ServiceEndpoint::class,
    ];
}

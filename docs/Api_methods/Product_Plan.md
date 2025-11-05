## Product Plan API

* [getAll()](#getall)
* [getDetails()](#getdetails)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing product plans.

#### Signature

getAll([Filter\Product\Plan\GetAll](../Filters/Product/Plan/GetAll.md) \$filters = null): [DataObject\Product\Plan\Existing[]](../Data_objects/Product/Plan/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [BadRequestException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Filter;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$filters = Filter\Product\Plan\GetAll::build();

$filters->typeId = 11;
$filters->limit = 10;
$filters->page = 1;

try {
    $plans = $api->products->plans->getAll($filters);

    foreach ($plans as $plan) {
        echo 'ID: ' . $plan->id . PHP_EOL;
        echo 'Name: ' . $plan->name . PHP_EOL;
    }

    echo 'Total items: ' . $plans->totalItems . PHP_EOL;
    echo 'Total pages: ' . $plans->totalPages . PHP_EOL;
    echo 'Current page: ' . $plans->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details about single product plan.

#### Signature

getDetails(int \$plan_id): [DataObject\Product\Plan\Existing](../Data_objects/Product/Plan/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\PredefinedValue;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $plan = $api->products->plans->getDetails(2595);

    echo 'Plan ID: ' . $plan->id . PHP_EOL;
    echo 'Type ID: ' . $plan->typeId . PHP_EOL;
    echo 'Name: ' . $plan->name . PHP_EOL;
    echo 'Periods: ' . PHP_EOL;

    foreach ($plan->periods as $period) {
        echo '  Period: ' . $period->period . PHP_EOL;
        echo '  Is FREE trial: ' . ($period->isFreeTrial ? 'yes' : 'no') . PHP_EOL;
        echo '  Is renewable: ' . ($period->isRenewable ? 'yes' : 'no') . PHP_EOL;
        echo '  Expires: ' . ($period->expires ? 'yes' : 'no') . PHP_EOL;
        echo '  Register price: ' . $period->price->register . PHP_EOL;
        echo '  Renew price: ' . $period->price->renew . PHP_EOL;
        echo '  =======' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


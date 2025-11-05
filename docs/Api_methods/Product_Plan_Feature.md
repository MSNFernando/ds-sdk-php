## Product Plan Feature API

* [getAll()](#getall)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing product plan features.

#### Signature

getAll(int \$plan_id, [Filter\Product\Plan\Feature\GetAll](../Filters/Product/Plan/Feature/GetAll.md) \$filters = null): [DataObject\Product\Plan\Feature[]](../Data_objects/Product/Plan/Feature.md) 

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
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$filters = Filter\Product\Plan\Feature\GetAll::build();
$filters->types = [ 'core', 'hosting_manager' ];

try {
    $features = $api->products->plans->features->getAll(117, $filters);

    foreach ($features as $feature) {
        echo 'Type: ' . $feature->type . PHP_EOL;
        echo 'Values:' . PHP_EOL;

        foreach ($feature->values as $value) {
            echo '  Value: ' . $value->value . PHP_EOL;
            echo '  Periods: ' . PHP_EOL;

            foreach ($value->periods as $period) {
                echo '    Period: ' . $period->period . PHP_EOL;
                echo '    Wholesale price: ' . $period->price->wholesale . PHP_EOL;
                echo '    Registration price: ' . $period->price->register . PHP_EOL;
                echo '    Renewal price: ' . $period->price->renew . PHP_EOL;
            }
        }
    }
} catch (Exception\BadRequestException $e) {
// Handle the errors in $e->getErrors().
}
```


## Servers Product Features API

* [getAll()](#getall)
* [register()](#register)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Servers product features.

#### Signature

getAll(int \$product_id, [Filter\Product\Servers\Feature\GetAll](../Filters/Product/Servers/Feature/GetAll.md) \$filters = null): [DataObject\Product\Servers\Feature\Existing[]](../Data_objects/Product/Servers/Feature/Existing.md) 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

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

$filters = Filter\Product\Servers\Feature\GetAll::build();
$filters->limit = 10;
$filters->page = 1;

try {
    $features = $api->products->servers->features->getAll(123456, $filters);

    foreach ($features as $feature) {
        echo 'Feature ID: ' . $feature->id . PHP_EOL;
        echo 'Type: ' . $feature->type . PHP_EOL;
        echo 'Value: ' . $feature->value . PHP_EOL;
        echo '=========' . PHP_EOL;
    }

    echo 'Total items: ' . $features->totalItems . PHP_EOL;
    echo 'Total pages: ' . $features->totalPages . PHP_EOL;
    echo 'Current page: ' . $features->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### register()<a name="register"></a>

#### Description

Create new Servers product feature.

#### Signature

register(int \$product_id, [DataObject\Product\Servers\Feature\Register](../Data_objects/Product/Servers/Feature/Register.md) \$data_object): [DataObject\Product\Servers\Feature\Existing](../Data_objects/Product/Servers/Feature/Existing.md) 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $new_feature = DataObject\Product\Servers\Feature\Register::build()
        ->setType(PredefinedValue\Product\Servers\Feature::TYPE_SSD)
        ->setValue(50_000)
        ->setPeriod(12);
    $feature = $api->products->servers->features->register(123456, $new_feature);

    echo 'Feature ID: ' . $feature->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### terminate()<a name="terminate"></a>

#### Description

Terminates Servers product feature.

#### Signature

terminate(int \$product_id, int \$feature_id): bool 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $api->products->servers->features->terminate(123456, 123456);

    echo 'Feature successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


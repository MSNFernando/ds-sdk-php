## Product Type API

* [getAll()](#getall)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing product types.

#### Signature

getAll([Filter\Product\Type\GetAll](../Filters/Product/Type/GetAll.md) \$filters = null): [DataObject\Product\Type\Existing[]](../Data_objects/Product/Type/Existing.md) 

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

$filters = Filter\Product\Type\GetAll::build();

$filters->limit = 10;
$filters->page = 1;

try {
    $types = $api->products->types->getAll($filters);

    foreach ($types as $type) {
        echo 'Type ID: ' . $type->id . PHP_EOL;
        echo 'Name: ' . $type->name . PHP_EOL;
    }

    echo 'Total items: ' . $types->totalItems . PHP_EOL;
    echo 'Total pages: ' . $types->totalPages . PHP_EOL;
    echo 'Current page: ' . $types->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```


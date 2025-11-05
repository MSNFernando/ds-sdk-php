## Servers Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [createLoginLink()](#createloginlink)
* [register()](#register)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Servers products.

#### Signature

getAll([Filter\Product\Servers\GetAll](../Filters/Product/Servers/GetAll.md) \$filters = null): [DataObject\Product\Servers\Existing[]](../Data_objects/Product/Servers/Existing.md) 

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

$filters = Filter\Product\Servers\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->servers->getAll($filters);

    foreach ($products as $product) {
        echo 'Product ID: ' . $product->id . PHP_EOL;
        echo 'Product Name: ' . $product->name . PHP_EOL;
    }

    echo 'Total items: ' . $products->totalItems . PHP_EOL;
    echo 'Total pages: ' . $products->totalPages . PHP_EOL;
    echo 'Current page: ' . $products->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details about single Servers product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\Servers\Existing](../Data_objects/Product/Servers/Existing.md) 

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
    $product = $api->products->servers->getDetails(123456);

    echo 'Product ID: ' . $product->id . PHP_EOL;
    echo 'Product Name: ' . $product->name . PHP_EOL;

    if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
        echo 'Product is registered' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### createLoginLink()<a name="createloginlink"></a>

#### Description

Creates a login link for Servers product.

#### Signature

createLoginLink(int \$product_id, [DataObject\Product\Servers\LoginLink\Create](../Data_objects/Product/Servers/LoginLink/Create.md) \$data_object = null): [DataObject\Product\Servers\LoginLink\Existing](../Data_objects/Product/Servers/LoginLink/Existing.md) 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $login_link = $api->products->servers->createLoginLink(123456);

    echo 'Login link: ' . $login_link->link . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new Servers product.

#### Signature

register([DataObject\Product\Servers\Register](../Data_objects/Product/Servers/Register.md) \$data_object): [DataObject\Product\Servers\Existing](../Data_objects/Product/Servers/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [BadRequestException](../Handling_of_errors.md#list-of-exceptions)
* [PaymentRequiredException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\PredefinedValue;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$new_product = DataObject\Product\Servers\Register::build()
    ->setCustomerId(123456)
    ->setPlanId(117)
    ->setPeriod(12)
    ->setLocation(PredefinedValue\Product\Servers::LOCATION_AU)
    ->setOperatingSystem('Ubuntu 20.04');

// Add feature.
$new_product->features->add(DataObject\Product\Servers\Feature\Register::build()
    ->setType(PredefinedValue\Product\Servers\Feature::TYPE_HOSTING_MANAGER)
    ->setValue('cPanel')
    ->setPeriod(12)
);

// Add multiple features.
$new_product->features->import([
    DataObject\Product\Servers\Feature\Register::build()
        ->setType(PredefinedValue\Product\Servers\Feature::TYPE_BANDWIDTH)
        ->setValue(9)
        ->setPeriod(12),
    DataObject\Product\Servers\Feature\Register::build()
        ->setType(PredefinedValue\Product\Servers\Feature::TYPE_CORE)
        ->setValue(4)
        ->setPeriod(12)
]);

try {
    $product = $api->products->servers->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews Servers product.

#### Signature

renew(int \$product_id, [DataObject\Product\Servers\Renew](../Data_objects/Product/Servers/Renew.md) \$data_object = null): [DataObject\Product\Servers\Existing](../Data_objects/Product/Servers/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)
* [BadRequestException](../Handling_of_errors.md#list-of-exceptions)
* [PaymentRequiredException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\PredefinedValue;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$renew_product = DataObject\Product\Servers\Renew::build();
$renew_product->period = 24;

// Add multiple features.
$renew_product->features->import([
    DataObject\Product\Servers\Feature\Renew::build()
        ->setType(PredefinedValue\Product\Servers\Feature::TYPE_SSD)
        ->setPeriod(24),
    DataObject\Product\Servers\Feature\Renew::build()
        ->setType(PredefinedValue\Product\Servers\Feature::TYPE_RAM)
        ->setPeriod(24)
]);

try {
    $product = $api->products->servers->renew(123456, $renew_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### terminate()<a name="terminate"></a>

#### Description

Terminates Servers product.

#### Signature

terminate(int \$product_id): bool 

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

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $api->products->servers->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


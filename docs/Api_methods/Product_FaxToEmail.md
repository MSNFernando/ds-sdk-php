## Fax to Email Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [register()](#register)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Fax to Email products.

#### Signature

getAll([Filter\Product\FaxToEmail\GetAll](../Filters/Product/FaxToEmail/GetAll.md) \$filters = null): [DataObject\Product\FaxToEmail\Existing[]](../Data_objects/Product/FaxToEmail/Existing.md) 

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

$filters = Filter\Product\FaxToEmail\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->faxToEmails->getAll($filters);

    foreach ($products as $product) {
        echo 'Product ID: ' . $product->id . PHP_EOL;
        echo 'Plan ID: ' . $product->planId . PHP_EOL;
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

Returns the details about single Fax to Email product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\FaxToEmail\Existing](../Data_objects/Product/FaxToEmail/Existing.md) 

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
    $product = $api->products->faxToEmails->getDetails(123456);

    echo 'Product ID: ' . $product->id . PHP_EOL;
    echo 'Plan ID: ' . $product->planId . PHP_EOL;

    if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
        echo 'Product is registered' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new Fax to Email product.

#### Signature

register([DataObject\Product\FaxToEmail\Register](../Data_objects/Product/FaxToEmail/Register.md) \$data_object): [DataObject\Product\FaxToEmail\Existing](../Data_objects/Product/FaxToEmail/Existing.md) 

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

$new_product = DataObject\Product\FaxToEmail\Register::build()
    ->setCustomerId(123456)
    ->setPlanId(243)
    ->setPeriod(12)
    ->setCountry(PredefinedValue\Product\FaxToEmail::COUNTRY_AU)
    ->setState('nsw');

try {
    $product = $api->products->faxToEmails->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews Fax to Email product.

#### Signature

renew(int \$product_id, [DataObject\Product\FaxToEmail\Renew](../Data_objects/Product/FaxToEmail/Renew.md) \$data_object = null): [DataObject\Product\FaxToEmail\Existing](../Data_objects/Product/FaxToEmail/Existing.md) 

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

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$renew_product = DataObject\Product\FaxToEmail\Renew::build();
$renew_product->period = 24;

try {
    $product = $api->products->faxToEmails->renew(123456, $renew_product);

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

Terminates Fax to Email product.

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
    $api->products->faxToEmails->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


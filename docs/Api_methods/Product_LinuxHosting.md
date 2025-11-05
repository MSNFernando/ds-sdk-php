## Linux Hosting Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [createLoginLink()](#createloginlink)
* [register()](#register)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Linux Hosting products.

#### Signature

getAll([Filter\Product\LinuxHosting\GetAll](../Filters/Product/LinuxHosting/GetAll.md) \$filters = null): [DataObject\Product\LinuxHosting\Existing[]](../Data_objects/Product/LinuxHosting/Existing.md) 

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

$filters = Filter\Product\LinuxHosting\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->linuxHostings->getAll($filters);

    foreach ($products as $product) {
        echo 'Product ID: ' . $product->id . PHP_EOL;
        echo 'Domain Name: ' . $product->domainName . PHP_EOL;
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

Returns the details about single Linux Hosting product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\LinuxHosting\Existing](../Data_objects/Product/LinuxHosting/Existing.md) 

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
    $product = $api->products->linuxHostings->getDetails(123456);

    echo 'Product ID: ' . $product->id . PHP_EOL;
    echo 'Domain Name: ' . $product->domainName . PHP_EOL;

    if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
        echo 'Product is registered' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### createLoginLink()<a name="createloginlink"></a>

#### Description

Creates a login link for Linux Hosting product.

#### Signature

createLoginLink(int \$product_id, [DataObject\Product\LinuxHosting\LoginLink\Create](../Data_objects/Product/LinuxHosting/LoginLink/Create.md) \$data_object = null): [DataObject\Product\LinuxHosting\LoginLink\Existing](../Data_objects/Product/LinuxHosting/LoginLink/Existing.md) 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $login_link = $api->products->linuxHostings->createLoginLink(123456);

    echo 'Login link: ' . $login_link->link . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new Linux Hosting product.

#### Signature

register([DataObject\Product\LinuxHosting\Register](../Data_objects/Product/LinuxHosting/Register.md) \$data_object): [DataObject\Product\LinuxHosting\Existing](../Data_objects/Product/LinuxHosting/Existing.md) 

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

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$new_product = DataObject\Product\LinuxHosting\Register::build()
    ->setCustomerId(123456)
    ->setDomainName('crazydomains.com.au')
    ->setPlanId(29)
    ->setPeriod(12);

try {
    $product = $api->products->linuxHostings->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews Linux Hosting product.

#### Signature

renew(int \$product_id, [DataObject\Product\LinuxHosting\Renew](../Data_objects/Product/LinuxHosting/Renew.md) \$data_object = null): [DataObject\Product\LinuxHosting\Existing](../Data_objects/Product/LinuxHosting/Existing.md) 

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

$renew_product = DataObject\Product\LinuxHosting\Renew::build();
$renew_product->period = 24;

try {
    $product = $api->products->linuxHostings->renew(123456, $renew_product);

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

Terminates Linux Hosting product.

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
    $api->products->linuxHostings->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


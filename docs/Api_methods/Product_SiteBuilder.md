## Site Builder Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [createLoginLink()](#createloginlink)
* [register()](#register)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Site Builder products.

#### Signature

getAll([Filter\Product\SiteBuilder\GetAll](../Filters/Product/SiteBuilder/GetAll.md) \$filters = null): [DataObject\Product\SiteBuilder\Existing[]](../Data_objects/Product/SiteBuilder/Existing.md) 

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

$filters = Filter\Product\SiteBuilder\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->siteBuilders->getAll($filters);

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

Returns the details about single Site Builder product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\SiteBuilder\Existing](../Data_objects/Product/SiteBuilder/Existing.md) 

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
    $product = $api->products->siteBuilders->getDetails(123456);

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

Creates a login link for Site Builder product.

#### Signature

createLoginLink(int \$product_id, [DataObject\Product\SiteBuilder\LoginLink\Create](../Data_objects/Product/SiteBuilder/LoginLink/Create.md) \$data_object = null): [DataObject\Product\SiteBuilder\LoginLink\Existing](../Data_objects/Product/SiteBuilder/LoginLink/Existing.md) 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $login_link = $api->products->siteBuilders->createLoginLink(123456);

    echo 'Login link: ' . $login_link->link . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new Site Builder product.

#### Signature

register([DataObject\Product\SiteBuilder\Register](../Data_objects/Product/SiteBuilder/Register.md) \$data_object): [DataObject\Product\SiteBuilder\Existing](../Data_objects/Product/SiteBuilder/Existing.md) 

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

$new_product = DataObject\Product\SiteBuilder\Register::build()
    ->setCustomerId(123456)
    ->setDomainName('crazydomains.com.au')
    ->setPlanId(2042)
    ->setPeriod(12);

try {
    $product = $api->products->siteBuilders->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews Site Builder product.

#### Signature

renew(int \$product_id, [DataObject\Product\SiteBuilder\Renew](../Data_objects/Product/SiteBuilder/Renew.md) \$data_object = null): [DataObject\Product\SiteBuilder\Existing](../Data_objects/Product/SiteBuilder/Existing.md) 

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

$renew_product = DataObject\Product\SiteBuilder\Renew::build();
$renew_product->period = 24;

try {
    $product = $api->products->siteBuilders->renew(123456, $renew_product);

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

Terminates Site Builder product.

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
    $api->products->siteBuilders->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


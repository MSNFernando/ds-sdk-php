## Site Protection Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [createLoginLink()](#createloginlink)
* [register()](#register)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing Site Protection products.

#### Signature

getAll([Filter\Product\SiteProtection\GetAll](../Filters/Product/SiteProtection/GetAll.md) \$filters = null): [DataObject\Product\SiteProtection\Existing[]](../Data_objects/Product/SiteProtection/Existing.md) 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\PredefinedValue;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$filters = Filter\Product\SiteProtection\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->siteProtections->getAll($filters);

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

Returns the details about single Site Protection product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\SiteProtection\Existing](../Data_objects/Product/SiteProtection/Existing.md) 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

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
    $product = $api->products->siteProtections->getDetails(123456);

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

Creates a login link for Site Protection product.

#### Signature

createLoginLink(int \$product_id, [DataObject\Product\SiteProtection\LoginLink\Create](../Data_objects/Product/SiteProtection/LoginLink/Create.md) \$data_object = null): [DataObject\Product\SiteProtection\LoginLink\Existing](../Data_objects/Product/SiteProtection/LoginLink/Existing.md) 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $login_link = $api->products->siteProtections->createLoginLink(123456);

    echo 'Login link: ' . $login_link->link . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new Site Protection product.

#### Signature

register([DataObject\Product\SiteProtection\Register](../Data_objects/Product/SiteProtection/Register.md) \$data_object): [DataObject\Product\SiteProtection\Existing](../Data_objects/Product/SiteProtection/Existing.md) 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

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

$new_product = DataObject\Product\SiteProtection\Register::build()
    ->setCustomerId(123456)
    ->setDomainName('crazydomains.com.au')
    ->setPlanId(548)
    ->setPeriod(12);

try {
    $product = $api->products->siteProtections->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews Site Protection product.

#### Signature

renew(int \$product_id, [DataObject\Product\SiteProtection\Renew](../Data_objects/Product/SiteProtection/Renew.md) \$data_object = null): [DataObject\Product\SiteProtection\Existing](../Data_objects/Product/SiteProtection/Existing.md) 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$renew_product = DataObject\Product\SiteProtection\Renew::build();
$renew_product->period = 24;

try {
    $product = $api->products->siteProtections->renew(123456, $renew_product);

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

Terminates Site Protection product.

#### Signature

terminate(int \$product_id): bool 

#### Throws

* [InvalidArgumentException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $api->products->siteProtections->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


## SSL Certificate Product API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [register()](#register)
* [getCertificateDetails()](#getcertificatedetails)
* [reissueAuto()](#reissueauto)
* [reissueManual()](#reissuemanual)
* [getFile()](#getfile)
* [getDcv()](#getdcv)
* [updateDcv()](#updatedcv)
* [getDcvHttp()](#getdcvhttp)
* [getDcvCname()](#getdcvcname)
* [getDcvEmail()](#getdcvemail)
* [renew()](#renew)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing SSL Certificate products.

#### Signature

getAll([Filter\Product\SslCertificate\GetAll](../Filters/Product/SslCertificate/GetAll.md) \$filters = null): [DataObject\Product\SslCertificate\Existing[]](../Data_objects/Product/SslCertificate/Existing.md) 

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

$filters = Filter\Product\SslCertificate\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $products = $api->products->sslCertificates->getAll($filters);

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

Returns the details about single SSL Certificate product.

#### Signature

getDetails(int \$product_id): [DataObject\Product\SslCertificate\Existing](../Data_objects/Product/SslCertificate/Existing.md) 

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
    $product = $api->products->sslCertificates->getDetails(123456);

    echo 'Product ID: ' . $product->id . PHP_EOL;
    echo 'Domain Name: ' . $product->domainName . PHP_EOL;

    if ($product->statusId === PredefinedValue\Product::STATUS_REGISTERED) {
        echo 'Product is registered' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new SSL Certificate product.

#### Signature

register([DataObject\Product\SslCertificate\Register](../Data_objects/Product/SslCertificate/Register.md) \$data_object): [DataObject\Product\SslCertificate\Existing](../Data_objects/Product/SslCertificate/Existing.md) 

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

$new_product = DataObject\Product\SslCertificate\Register::build()
    ->setCustomerId(123456)
    ->setDomainName('crazydomains.com.au')
    ->setPlanId(65)
    ->setPeriod(12)
    ->setHostedWith(PredefinedValue\Product\SslCertificate::HOSTED_WITH_EXTERNAL)
    ->setCsr('-----BEGIN CERTIFICATE REQUEST----- ... -----END CERTIFICATE REQUEST-----')
    ->setServerSoftware(1)
    ->setAutoFillDetails(true);

try {
    $product = $api->products->sslCertificates->register($new_product);

    echo 'Product ID: ' . $product->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### getCertificateDetails()<a name="getcertificatedetails"></a>

#### Description

Returns the certificate details of SSL Certificate product.

#### Signature

getCertificateDetails(int \$product_id): [DataObject\Product\SslCertificate\CertificateDetails](../Data_objects/Product/SslCertificate/CertificateDetails.md) 

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
    $certificateDetails = $api->products->sslCertificates->getCertificateDetails(123456);

    echo 'Common Name: ' . $certificateDetails->commonName . PHP_EOL;
    echo 'Organization: ' . $certificateDetails->organization . PHP_EOL;
    echo 'CSR: ' . $certificateDetails->csr . PHP_EOL;
    echo 'Server software ID: ' . $certificateDetails->serverSoftware . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### reissueAuto()<a name="reissueauto"></a>

#### Description

Process the reissue of SSL Certificate with automated generation of CSR-code.

#### Signature

reissueAuto(int \$product_id, [DataObject\Product\SslCertificate\Reissue\Auto](../Data_objects/Product/SslCertificate/Reissue/Auto.md) \$data_object): [DataObject\Product\SslCertificate\CertificateDetails](../Data_objects/Product/SslCertificate/CertificateDetails.md) 

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
use Dreamscape\ResellerApiSdk\DataObject;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $reissue = DataObject\Product\SslCertificate\Reissue\Auto::build();
    $reissue->commonName = 'crazydomains.com';
    $reissue->organization = 'Crazy Domains';
    $reissue->organizationUnit = 'IT';
    $reissue->country = 'AU';
    $reissue->state = 'NSW';
    $reissue->city = 'Sydney';
    $reissue->email = 'admin@crazydomains.com';
    $reissue->serverSoftware = 1;

    $api->products->sslCertificates->reissueAuto(123456, $reissue);
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### reissueManual()<a name="reissuemanual"></a>

#### Description

Process the reissue of SSL Certificate with manually generated CSR-code.

#### Signature

reissueManual(int \$product_id, [DataObject\Product\SslCertificate\Reissue\Manual](../Data_objects/Product/SslCertificate/Reissue/Manual.md) \$data_object): [DataObject\Product\SslCertificate\CertificateDetails](../Data_objects/Product/SslCertificate/CertificateDetails.md) 

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
use Dreamscape\ResellerApiSdk\DataObject;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $reissue = DataObject\Product\SslCertificate\Reissue\Manual::build();
    $reissue->csr = '-----BEGIN CERTIFICATE REQUEST----- ... -----END CERTIFICATE REQUEST-----';
    $reissue->serverSoftware = 1;

    $api->products->sslCertificates->reissueManual(123456, $reissue);
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getFile()<a name="getfile"></a>

#### Description

Process the reissue of SSL Certificate with manually generated CSR-code.

#### Signature

getFile(int \$product_id): [DataObject\Product\SslCertificate\File](../Data_objects/Product/SslCertificate/File.md) 

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
    $file = $api->products->sslCertificates->getFile(123456);

    file_put_contents($file->name, $file->content);

    echo 'File saved to ' . $file->name . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDcv()<a name="getdcv"></a>

#### Description

Returns the DCV details of SSL Certificate product.

#### Signature

getDcv(int \$product_id): [DataObject\Product\SslCertificate\Dcv](../Data_objects/Product/SslCertificate/Dcv.md) 

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
    $dcv = $api->products->sslCertificates->getDcv(123456);

    echo 'Method: ' . $dcv->method . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### updateDcv()<a name="updatedcv"></a>

#### Description

Updates the DCV details of SSL Certificate product.

#### Signature

updateDcv(int \$product_id, [DataObject\Product\SslCertificate\Dcv\Update](../Data_objects/Product/SslCertificate/Dcv/Update.md) \$data_object): [DataObject\Product\SslCertificate\Dcv](../Data_objects/Product/SslCertificate/Dcv.md) 

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
use Dreamscape\ResellerApiSdk\DataObject;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $new_dcv = DataObject\Product\SslCertificate\Dcv\Update::build();
    $new_dcv->method = PredefinedValue\Product\SslCertificate::DCV_METHOD_EMAIL;
    $new_dcv->email = 'postmaster@crazydomains.com';
    $dcv = $api->products->sslCertificates->updateDcv(123456, $new_dcv);

    echo 'New method: ' . $dcv->method . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDcvHttp()<a name="getdcvhttp"></a>

#### Description

Returns the DCV HTTP details of SSL Certificate product.

#### Signature

getDcvHttp(int \$product_id): [DataObject\Product\SslCertificate\Dcv\Http](../Data_objects/Product/SslCertificate/Dcv/Http.md) 

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
    $dcvHttp = $api->products->sslCertificates->getDcvHttp(123456);

    echo 'Name: ' . $dcvHttp->name . PHP_EOL;
    echo 'Path: ' . $dcvHttp->path . PHP_EOL;
    echo 'URL: ' . $dcvHttp->url . PHP_EOL;
    echo 'Content: ' . $dcvHttp->content . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDcvCname()<a name="getdcvcname"></a>

#### Description

Returns the DCV CNAME details of SSL Certificate product.

#### Signature

getDcvCname(int \$product_id): [DataObject\Product\SslCertificate\Dcv\Cname](../Data_objects/Product/SslCertificate/Dcv/Cname.md) 

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
    $dcvCname = $api->products->sslCertificates->getDcvCname(123456);

    echo 'Name: ' . $dcvCname->name . PHP_EOL;
    echo 'Value: ' . $dcvCname->value . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDcvEmail()<a name="getdcvemail"></a>

#### Description

Returns the DCV EMAIL details of SSL Certificate product.

#### Signature

getDcvEmail(int \$product_id): [DataObject\Product\SslCertificate\Dcv\Email](../Data_objects/Product/SslCertificate/Dcv/Email.md) 

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
    $dcvEmail = $api->products->sslCertificates->getDcvEmail(123456);

    echo 'Emails: ' . implode(', ', $dcvEmail->emails) . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### renew()<a name="renew"></a>

#### Description

Renews SSL Certificate product.

#### Signature

renew(int \$product_id, [DataObject\Product\SslCertificate\Renew](../Data_objects/Product/SslCertificate/Renew.md) \$data_object = null): [DataObject\Product\SslCertificate\Existing](../Data_objects/Product/SslCertificate/Existing.md) 

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

$renew_product = DataObject\Product\SslCertificate\Renew::build();
$renew_product->period = 24;

try {
    $product = $api->products->sslCertificates->renew(123456, $renew_product);

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

Terminates SSL Certificate product.

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
    $api->products->sslCertificates->terminate(123456);

    echo 'Product successfully terminated';
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


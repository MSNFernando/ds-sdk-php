## Domain Host API

* [create()](#create)
* [getAll()](#getall)
* [getDetails()](#getdetails)
* [update()](#update)
* [delete()](#delete)

### create()<a name="create"></a>

#### Description

Creates new host.

#### Signature

create(int \$domain_id, [DataObject\Domain\Host\Create](../Data_objects/Domain/Host/Create.md) \$data_object): [DataObject\Domain\Host\Existing](../Data_objects/Domain/Host/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)
* [BadRequestException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$domain_id = 123456;
$new_host = DataObject\Domain\Host\Create::build();
$new_host->host = 'some-host.crazydomains.com.au';
$new_host->ip = '27.124.125.143';

try {
    $host = $api->domains->hosts->create($domain_id, $new_host);

    echo 'Host: ' . $host->host . PHP_EOL;
    echo 'IP: ' . $host->ip . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getAll()<a name="getall"></a>

#### Description

Returns the list of hosts.

#### Signature

getAll(int \$domain_id): [DataObject\Domain\Host\Existing[]](../Data_objects/Domain/Host/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$domain_id = 123456;

try {
    $hosts = $api->domains->hosts->getAll($domain_id);

    foreach ($hosts as $host) {
        echo 'Host: ' . $host->host . PHP_EOL;
        echo 'IP: ' . $host->ip . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details about single host.

#### Signature

getDetails(int \$domain_id, string \$host): [DataObject\Domain\Host\Existing](../Data_objects/Domain/Host/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$domain_id = 123456;
$hostname = 'some-host.crazydomains.com.au';

try {
    $host = $api->domains->hosts->getDetails($domain_id, $hostname);

    echo 'Host: ' . $host->host . PHP_EOL;
    echo 'IP: ' . $host->ip . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### update()<a name="update"></a>

#### Description

Updates the details for a single host.

#### Signature

update(int \$domain_id, string \$host, [DataObject\Domain\Host\Update](../Data_objects/Domain/Host/Update.md) \$data_object): [DataObject\Domain\Host\Existing](../Data_objects/Domain/Host/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)
* [BadRequestException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$domain_id = 123456;
$hostname = 'some-host.crazydomains.com.au';
$update_host = DataObject\Domain\Host\Update::build();
$update_host->ip = '27.124.125.143';

try {
    $host = $api->domains->hosts->update($domain_id, $hostname, $update_host);

    echo 'Host: ' . $host->host . PHP_EOL;
    echo 'IP: ' . $host->ip . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### delete()<a name="delete"></a>

#### Description

Deletes host.

#### Signature

delete(int \$domain_id, string \$host): bool 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
* [NotFoundException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$domain_id = 123456;
$hostname = 'some-host.crazydomains.com.au';

try {
    $api->domains->hosts->delete($domain_id, $hostname);
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


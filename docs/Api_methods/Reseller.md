## Reseller API

* [getDetails()](#getdetails)

### getDetails()<a name="getdetails"></a>

#### Description

Returns the reseller details.

#### Signature

getDetails(): [DataObject\Reseller\Existing](../Data_objects/Reseller/Existing.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $reseller = $api->reseller->getDetails();

    echo 'Reseller ID: ' . $reseller->id . PHP_EOL;
    echo 'First Name: ' . $reseller->firstName . PHP_EOL;
    echo 'Last Name: ' . $reseller->lastName . PHP_EOL;
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```


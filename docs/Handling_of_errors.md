## Handling of Errors

Reseller API SDK provides exception-based mechanisms of errors handling.
This means that every SDK API method can throw an exception instead of returning an error.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(
    new Curl(
        new ApiKey('YourAPIKeyGoesHere'),
        'https://reseller-api.ds.network'
    )
);

try {
    $api->domains->register(DataObject\Domain\Register::build([
        'domainName' => 'crazydomains.com',
        'customerId' => 12345678,
        'period' => 12,
    ]));
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```

### List of exceptions<a name="list-of-exceptions"></a>

All exceptions in Reseller API SDK are placed under the `Dreamscape\ResellerApiSdk\Exception` namespace.

The Reseller API SDK provides the following exceptions:

| Exception class              | Description                                                                                                      |
|------------------------------|------------------------------------------------------------------------------------------------------------------|
| AuthenticationException      | Authentication credentials are invalid.                                                                          |
| BadRequestException          | The request cannot be processed because provided data is invalid.                                                |
| NotFoundException            | The requested resource could not be found.                                                                       |
| PaymentRequiredException     | Reseller account does not have sufficient funds to process the operation.                                        |
| InvalidResponseException     | Reseller REST API hasn’t returned a well formed response.                                                        |
| InternalServerErrorException | A generic error message, given when an unexpected condition was encountered and no specific message is suitable. |
| Http\ConnectException        | Issues with the network (eg: no internet connection, problems with network adapter, etc.).                       |
| Http\RequestException        | An error during the request (error during sending/receiving the request, etc.).                                  |

All of the exceptions are being inherited from the `ResellerApiSdkException` class. Calling the `getMessage()` method will allow you to get the details if the API returned it.

The exception `BadRequestException` should be especially noted. This exception has the `getErrors()` method that returns the list of errors returned by the Dreamscape Reseller REST API.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Exception;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(
    new Curl(
        new ApiKey('YourAPIKeyGoesHere'),
        'https://reseller-api.ds.network'
    )
);

try {
    $api->domains->register(DataObject\Domain\Register::build([
        'domainName' => 'crazydomains.com',
        'customerId' => 12345678,
        'period' => 12,
    ]));
} catch (Exception\BadRequestException $e) {
    $e->getErrors();
    /*
    [
        'The domain name crazydomains.com already registered',
    ]
    */
}
```

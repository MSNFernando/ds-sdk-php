## Domain Transfer API

* [checkAvailability()](#checkavailability)
* [start()](#start)
* [cancel()](#cancel)

### checkAvailability()<a name="checkavailability"></a>

#### Description

Checks the availability of transfer.

#### Signature

checkAvailability([DataObject\Domain\Transfer\Availability](../Data_objects/Domain/Transfer/Availability.md) \$data_object): [DataObject\Domain\Transfer\AvailabilityResult](../Data_objects/Domain/Transfer/AvailabilityResult.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)
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

$check_availability = DataObject\Domain\Transfer\Availability::build();
$check_availability->domainName = 'crazydomains.com.au';
$check_availability->authKey = 'UT%E623trvui2376!';

try {
    $transfer_availability = $api->domains->transfers->checkAvailability($check_availability);

    echo 'Is available: ' . ($transfer_availability->isAvailable ?  'Yes' : 'No') . PHP_EOL;
    echo 'Is eligible for renewal: '
        . ($transfer_availability->isEligibleForRenewal ?  'Yes' : 'No') . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### start()<a name="start"></a>

#### Description

Creates transfer request.

#### Signature

start([DataObject\Domain\Transfer\Start](../Data_objects/Domain/Transfer/Start.md) \$data_object): [DataObject\Domain\Existing](../Data_objects/Domain/Existing.md) 

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

$start_transfer = DataObject\Domain\Transfer\Start::build();
$start_transfer->customerId = 123456;
$start_transfer->domainName = 'crazydomains.com.au';
$start_transfer->authKey = 'UT%E623trvui2376!';
$start_transfer->period = 24;

try {
    $domain = $api->domains->transfers->start($start_transfer);

    echo 'Domain ID: ' . $domain->id . PHP_EOL;
    echo 'Domain status: ' . $domain->statusId . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### cancel()<a name="cancel"></a>

#### Description

Cancels transfer request.

#### Signature

cancel([DataObject\Domain\Transfer\Cancel](../Data_objects/Domain/Transfer/Cancel.md) \$data_object): bool 

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
use Dreamscape\ResellerApiSdk\PredefinedValue;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$cancel_transfer = DataObject\Domain\Transfer\Cancel::build();
$cancel_transfer->domainId = 123456;
$cancel_transfer->authKey = 'UT%E623trvui2376!';
$cancel_transfer->type = PredefinedValue\Domain::TRANSFER_TYPE_IN;

try {
    $api->domains->transfers->cancel($cancel_transfer);
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


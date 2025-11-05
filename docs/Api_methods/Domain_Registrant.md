## Domain Registrant API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [create()](#create)
* [update()](#update)

### getAll()<a name="getall"></a>

#### Description

Returns the list of registrants.

#### Signature

getAll([Filter\Domain\Registrant\GetAll](../Filters/Domain/Registrant/GetAll.md) \$filters = null): [DataObject\Domain\Registrant\Existing[]](../Data_objects/Domain/Registrant/Existing.md) 

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

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$filters = Filter\Domain\Registrant\GetAll::build();
$filters->page = 1;
$filters->limit = 10;

$registrants = $api->domains->registrants->getAll($filters);

try {
    foreach ($registrants as $registrant) {
        echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
        echo 'First Name: ' . $registrant->firstName . PHP_EOL;
        echo 'Last Name: ' . $registrant->lastName . PHP_EOL;

        if ($registrant->accountType === PredefinedValue\Domain\Registrant::ACCOUNT_TYPE_BUSINESS) {
            echo 'Business Name: ' . $registrant->businessName . PHP_EOL;
        }
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details about single registrant.

#### Signature

getDetails(int \$registrant_id): [DataObject\Domain\Registrant\Existing](../Data_objects/Domain/Registrant/Existing.md) 

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
    $registrant = $api->domains->registrants->getDetails(123456);

    echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
    echo 'First Name: ' . $registrant->firstName . PHP_EOL;
    echo 'Last Name: ' . $registrant->lastName . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### create()<a name="create"></a>

#### Description

Creates new registrant.

#### Signature

create([DataObject\Domain\Registrant\Create](../Data_objects/Domain/Registrant/Create.md) \$data_object): [DataObject\Domain\Registrant\Existing](../Data_objects/Domain/Registrant/Existing.md) 

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
use Dreamscape\ResellerApiSdk\PredefinedValue;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

try {
    $new_registrant = DataObject\Domain\Registrant\Create::build()
        ->setFirstName('John')
        ->setLastName('Doe')
        ->setAddress('123 Example Street')
        ->setCity('Testville')
        ->setCountry('AU')
        ->setState('WA')
        ->setPostCode('00000')
        ->setCountryCode(61)
        ->setPhone('912345678')
        ->setEmail('john.doe@crazydomains.com.au')
        ->setAccountType(PredefinedValue\Domain\Registrant::ACCOUNT_TYPE_BUSINESS)
        ->setBusinessName('John & Doe Corp')
        ->setBusinessNumberType('ABN')
        ->setBusinessNumber('12345678');
    $registrant = $api->domains->registrants->create($new_registrant);

    echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### update()<a name="update"></a>

#### Description

Updates the details of the single registrant.

#### Signature

update(int \$registrant_id, [DataObject\Domain\Registrant\Update](../Data_objects/Domain/Registrant/Update.md) \$data_object): [DataObject\Domain\Registrant\Existing](../Data_objects/Domain/Registrant/Existing.md) 

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

try {
    $update_registrant = DataObject\Domain\Registrant\Update::build();
    $update_registrant->firstName = 'John';
    $update_registrant->lastName = 'Doe';

    $registrant = $api->domains->registrants->update(123456, $update_registrant);

    echo 'Registrant ID: ' . $registrant->id . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```


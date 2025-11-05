## Customer API

* [getAll()](#getall)
* [getDetails()](#getdetails)
* [createLoginLink()](#createloginlink)
* [create()](#create)
* [update()](#update)
* [terminate()](#terminate)

### getAll()<a name="getall"></a>

#### Description

Returns the list of customers.

#### Signature

getAll([Filter\Customer\GetAll](../Filters/Customer/GetAll.md) \$filters = null): [DataObject\Customer\Existing[]](../Data_objects/Customer/Existing.md) 

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

$filters = Filter\Customer\GetAll::build();
$filters->page = 1;
$filters->limit = 10;

try {
    $customers = $api->customers->getAll($filters);

    foreach ($customers as $customer) {
        echo 'Customer ID: ' . $customer->id . PHP_EOL;
        echo 'First Name: ' . $customer->firstName . PHP_EOL;
        echo 'Last Name: ' . $customer->lastName . PHP_EOL;

        if ($customer->statusId === PredefinedValue\Customer::STATUS_ACTIVE) {
            echo 'Customer is active' . PHP_EOL;
        }
    }
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details of a single customer.

#### Signature

getDetails(int \$customer_id): [DataObject\Customer\Existing](../Data_objects/Customer/Existing.md) 

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
    $customer = $api->customers->getDetails(123456);

    echo 'Customer ID: ' . $customer->id . PHP_EOL;
    echo 'First Name: ' . $customer->firstName . PHP_EOL;
    echo 'Last Name: ' . $customer->lastName . PHP_EOL;

    if ($customer->statusId === PredefinedValue\Customer::STATUS_ACTIVE) {
        echo 'Customer is active' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### createLoginLink()<a name="createloginlink"></a>

#### Description

Creates a login link for a customer.

#### Signature

createLoginLink(int \$customer_id, [DataObject\Customer\LoginLink\Create](../Data_objects/Customer/LoginLink/Create.md) \$data_object = null): [DataObject\Customer\LoginLink\Existing](../Data_objects/Customer/LoginLink/Existing.md) 

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
    $login_link = $api->customers->createLoginLink(123456);

    echo 'Login link: ' . $login_link->link . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### create()<a name="create"></a>

#### Description

Creates new customer.

#### Signature

create([DataObject\Customer\Create](../Data_objects/Customer/Create.md) \$data_object): [DataObject\Customer\Existing](../Data_objects/Customer/Existing.md) 

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
    $new_customer = DataObject\Customer\Create::build()
        ->setFirstName('John')
        ->setLastName('Doe')
        ->setAddress('123 Example Street')
        ->setCity('Testville')
        ->setCountry('AU')
        ->setState('WA')
        ->setPostCode('00000')
        ->setCountryCode(61)
        ->setPhone('912345678')
        ->setMobile('912345678')
        ->setEmail('john.doe@crazydomains.com.au')
        ->setAccountType(PredefinedValue\Customer::ACCOUNT_TYPE_BUSINESS)
        ->setBusinessName('John & Doe Corp')
        ->setBusinessNumberType('ABN')
        ->setBusinessNumber('12345678');

    $new_customer->username = 'john_doe';
    $new_customer->password = 'NWx9673z9gptzVJN';

    $customer = $api->customers->create($new_customer);

    echo 'Customer ID: ' . $customer->id . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### update()<a name="update"></a>

#### Description

Updates the details of a single customer.

#### Signature

update(int \$customer_id, [DataObject\Customer\Update](../Data_objects/Customer/Update.md) \$data_object): [DataObject\Customer\Existing](../Data_objects/Customer/Existing.md) 

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
    $update_customer = DataObject\Customer\Update::build();
    $update_customer->firstName = 'John';
    $update_customer->lastName = 'Doe';
    $update_customer->username = 'john_doe_2';

    $customer = $api->customers->update(123456, $update_customer);

    echo 'Customer ID: ' . $customer->id . PHP_EOL;
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### terminate()<a name="terminate"></a>

#### Description

Terminates the customer.

#### Signature

terminate(int \$customer_id): bool 

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
    $api->customers->terminate(123456);
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


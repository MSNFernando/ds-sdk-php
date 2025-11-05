## Domain API

* [getAvailableTlds()](#getavailabletlds)
* [checkAvailability()](#checkavailability)
* [getAll()](#getall)
* [getDetails()](#getdetails)
* [register()](#register)
* [update()](#update)
* [renew()](#renew)
* [terminate()](#terminate)

### getAvailableTlds()<a name="getavailabletlds"></a>

#### Description

Returns the list of available TLDs with prices.

#### Signature

getAvailableTlds([Filter\Domain\AvailableTlds](../Filters/Domain/AvailableTlds.md) \$filters = null): [DataObject\Domain\Tld[]](../Data_objects/Domain/Tld.md) 

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

$filters = Filter\Domain\AvailableTlds::build();
$filters->customerId = 123456;
$filters->currency = 'AUD';
$filters->tlds = [ 'com.au', 'net.au' ];
$filters->page = 1;
$filters->limit = 10;

try {
    $tlds = $api->domains->getAvailableTlds($filters);

    foreach ($tlds as $tld) {
        echo 'TLD: ' . $tld->tld . PHP_EOL;
        echo 'Minimal period: ' . $tld->minPeriod . PHP_EOL;
        echo 'Register price: ' . $tld->price->register . PHP_EOL;
    }

    echo 'Total items: ' . $tlds->totalItems . PHP_EOL;
    echo 'Total pages: ' . $tlds->totalPages . PHP_EOL;
    echo 'Current page: ' . $tlds->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### checkAvailability()<a name="checkavailability"></a>

#### Description

Checks the availability of domain names.

#### Signature

checkAvailability(array \$domain_names, [Filter\Domain\CheckAvailability](../Filters/Domain/CheckAvailability.md) \$filters = null): [DataObject\Domain\AvailabilityResult[]](../Data_objects/Domain/AvailabilityResult.md) 

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

$filters = Filter\Domain\CheckAvailability::build();
$filters->customerId = 123456;
$filters->currency = 'AUD';

$domain_names = [ 'crazydomains.com.au', 'vodien.com.au' ];

try {
    $availability_results = $api->domains->checkAvailability($domain_names, $filters);

    foreach ($availability_results as $availability_result) {
        echo 'Domain name:' . $availability_result->domainName . PHP_EOL;
        echo 'Available: ' . ($availability_result->isAvailable ? 'yes' : 'no') . PHP_EOL;
    }
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getAll()<a name="getall"></a>

#### Description

Returns the list of existing domain names.

#### Signature

getAll([Filter\Domain\GetAll](../Filters/Domain/GetAll.md) \$filters = null): [DataObject\Domain\Existing[]](../Data_objects/Domain/Existing.md) 

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

$filters = Filter\Domain\GetAll::build();

$filters->customerId = 123456;
$filters->statusId = 1;
$filters->limit = 10;
$filters->page = 1;

try {
    $domains = $api->domains->getAll($filters);

    foreach ($domains as $domain) {
        echo 'Domain ID: ' . $domain->id . PHP_EOL;
        echo 'Domain Name: ' . $domain->domainName . PHP_EOL;
        echo 'Name servers:' . PHP_EOL;

        if ($domain->statusId === PredefinedValue\Domain::STATUS_REGISTERED) {
            echo 'Domain name is registered' . PHP_EOL;
        }

        foreach ($domain->nameServers as $i => $nameServer) {
            echo 'NS #' . $i . ' Host: ' . $nameServer->host . PHP_EOL;
            echo 'NS #' . $i . ' IP: ' . $nameServer->ip . PHP_EOL;
        }
    }

    echo 'Total items: ' . $domains->totalItems . PHP_EOL;
    echo 'Total pages: ' . $domains->totalPages . PHP_EOL;
    echo 'Current page: ' . $domains->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### getDetails()<a name="getdetails"></a>

#### Description

Returns the details about single domain name.

#### Signature

getDetails(int \$domain_id): [DataObject\Domain\Existing](../Data_objects/Domain/Existing.md) 

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
    $domain = $api->domains->getDetails(123456);

    echo 'Domain ID: ' . $domain->id . PHP_EOL;
    echo 'Domain Name: ' . $domain->domainName . PHP_EOL;

    if ($domain->statusId === PredefinedValue\Domain::STATUS_REGISTERED) {
        echo 'Domain name is registered' . PHP_EOL;
    }
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```

### register()<a name="register"></a>

#### Description

Registers new domain name.

#### Signature

register([DataObject\Domain\Register](../Data_objects/Domain/Register.md) \$data_object): [DataObject\Domain\Existing](../Data_objects/Domain/Existing.md) 

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

$new_domain = DataObject\Domain\Register::build();

$new_domain->setDomainName('crazydomains.com.au')
   ->setCustomerId(123456);

// Add nameserver.
$new_domain->nameServers->add(
    DataObject\Domain\NameServer\Create::build([
        'host' => 'ns1.secureparkme.com',
]));

// Add multiple nameservers.
$new_domain->nameServers->import([
    DataObject\Domain\NameServer\Create::build()->setHost('ns2.secureparkme.com'),
    DataObject\Domain\NameServer\Create::build()->setHost('ns3.secureparkme.com'),
]);

// Set eligibility details. The format is the same as in the documentation to REST API methods.
$new_domain->eligibility = [
    [ 'name' => 'business_type', 'value' => 'Other' ],
    [ 'name' => 'business_name', 'value' => 'Crazy Domains' ],
    [ 'name' => 'business_number_type', 'value' => 'ABN' ],
    [ 'name' => 'business_number', 'value' => '95851604390' ],
];

try {
    $domain = $api->domains->register($new_domain);

    echo 'Domain ID: ' . $domain->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
} catch (Exception\PaymentRequiredException $e) {
    // Handle the exception.
}
```

### update()<a name="update"></a>

#### Description

Updates the details for a single domain name.

#### Signature

update(int \$domain_id, [DataObject\Domain\Update](../Data_objects/Domain/Update.md) \$data_object): [DataObject\Domain\Existing](../Data_objects/Domain/Existing.md) 

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

$domain_update = DataObject\Domain\Update::build();

$domain_update->nameServers = DataObject\Collection::build(DataObject\Domain\NameServer\Create::class)
    ->add(DataObject\Domain\NameServer\Create::build()->setHost('ns1.secureparkme.com'))
    ->add(DataObject\Domain\NameServer\Create::build()->setHost('ns2.secureparkme.com'));

$domain_update->setIsLocked(true);

try {
    // Returns the data-object of updated domain.
    $domain = $api->domains->update(123456, $domain_update);

    echo 'Domain ID: ' . $domain->id;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```

### renew()<a name="renew"></a>

#### Description

Renews domain name.

#### Signature

renew(int \$domain_id, [DataObject\Domain\Renew](../Data_objects/Domain/Renew.md) \$data_object = null): [DataObject\Domain\Existing](../Data_objects/Domain/Existing.md) 

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

$renew_domain = DataObject\Domain\Renew::build();
$renew_domain->period = 24;

try {
    $domain = $api->domains->renew(123456, $renew_domain);

    echo 'Domain ID: ' . $domain->id;
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

Terminates domain name.

#### Signature

terminate(int \$domain_id): bool 

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
    $api->domains->terminate(123456);
} catch (Exception\NotFoundException $e) {
    // Handle the exception.
}
```


## Dictionary API

* [getSslServerSoftware()](#getsslserversoftware)
* [getServersOperatingSystems()](#getserversoperatingsystems)
* [getServersLocations()](#getserverslocations)
* [getWordPressLocations()](#getwordpresslocations)
* [getFaxToEmailLocations()](#getfaxtoemaillocations)

### getSslServerSoftware()<a name="getsslserversoftware"></a>

#### Description

Returns the list of SSL Server Software.

#### Signature

getSslServerSoftware(): [DataObject\Dictionary\SSLServerSoftware[]](../Data_objects/Dictionary/SSLServerSoftware.md) 

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
    $serverSoftwareList = $api->dictionary->getSslServerSoftware();

    foreach ($serverSoftwareList as $serverSoftware) {
        echo 'ID: ' . $serverSoftware->id . PHP_EOL;
        echo 'Name: ' . $serverSoftware->name . PHP_EOL;
        echo PHP_EOL;
    }
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```

### getServersOperatingSystems()<a name="getserversoperatingsystems"></a>

#### Description

Returns the list of Servers product operating systems.

#### Signature

getServersOperatingSystems(): [DataObject\Dictionary\ServersOperatingSystem[]](../Data_objects/Dictionary/ServersOperatingSystem.md) 

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
    $operatingSystems = $api->dictionary->getServersOperatingSystems();

    foreach ($operatingSystems as $operatingSystem) {
        echo 'Family: ' . $operatingSystem->family . PHP_EOL;
        echo 'Name: ' . $operatingSystem->name . PHP_EOL;
        echo PHP_EOL;
    }
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```

### getServersLocations()<a name="getserverslocations"></a>

#### Description

Returns the list of Servers product locations.

#### Signature

getServersLocations(): [DataObject\Dictionary\ServersLocation[]](../Data_objects/Dictionary/ServersLocation.md) 

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
    $locations = $api->dictionary->getServersLocations();

    foreach ($locations as $location) {
        echo 'Code: ' . $location->code . PHP_EOL;
        echo 'Name: ' . $location->name . PHP_EOL;
        echo PHP_EOL;
    }
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```

### getWordPressLocations()<a name="getwordpresslocations"></a>

#### Description

Returns the list of WordPress product locations.

#### Signature

getWordPressLocations(): [DataObject\Dictionary\WordPressLocation[]](../Data_objects/Dictionary/WordPressLocation.md) 

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
    $locations = $api->dictionary->getWordPressLocations();

    foreach ($locations as $location) {
        echo 'Code: ' . $location->code . PHP_EOL;
        echo 'Name: ' . $location->name . PHP_EOL;
        echo PHP_EOL;
    }
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```

### getFaxToEmailLocations()<a name="getfaxtoemaillocations"></a>

#### Description

Returns the list of Fax to Email product locations.

#### Signature

getFaxToEmailLocations(): [DataObject\Dictionary\FaxToEmailLocation[]](../Data_objects/Dictionary/FaxToEmailLocation.md) 

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
    $locations = $api->dictionary->getFaxToEmailLocations();

    foreach ($locations as $location) {
        echo 'Country: ' . $location->countryName . PHP_EOL;
        echo 'State: ' . $location->stateName . PHP_EOL;
        echo PHP_EOL;
    }
} catch (Exception\AuthenticationException $e) {
    // Handle the exception.
}
```


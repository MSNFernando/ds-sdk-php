## Finance API

* [getBalance()](#getbalance)
* [getCurrenciesList()](#getcurrencieslist)

### getBalance()<a name="getbalance"></a>

#### Description

Returns the balance details.

#### Signature

getBalance(): [DataObject\Finance\Balance](../Data_objects/Finance/Balance.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
$balance_details = $api->finances->getBalance();

echo 'Balance: ' . $balance_details->balance . PHP_EOL;
echo 'Currency: ' . $balance_details->currency . PHP_EOL;
```

### getCurrenciesList()<a name="getcurrencieslist"></a>

#### Description

Returns the list of currencies.

#### Signature

getCurrenciesList(): [DataObject\Finance\Currency[]](../Data_objects/Finance/Currency.md) 

#### Throws

* [AuthenticationException](../Handling_of_errors.md#list-of-exceptions)

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));
$currencies = $api->finances->getCurrenciesList();

foreach ($currencies as $currency) {
    echo $currency->name . ' (' . $currency->code . ')' . PHP_EOL;
}
```


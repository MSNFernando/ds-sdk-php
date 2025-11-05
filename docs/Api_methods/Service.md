## Service API

* [ping()](#ping)

### ping()<a name="ping"></a>

#### Description

Pings the service.

#### Signature

ping(): bool 

#### Example

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$is_alive = $api->service->ping();
```


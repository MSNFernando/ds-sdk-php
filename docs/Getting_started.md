## Getting Started

### Installation of library

1. Copy the library to the desired directory of your project (e.g. `libs/DreamcapeResellerApiSdk`).
2. Add the source of library to the autoloader.

    You can do it in the following ways:

    * for the `Dreamscape\ResellerApiSdk` namespace specify the path to the `src` directory in the PSR-4 autoloader that is being using in your project;
    * use the Composer's class autoloader:

        ```php
        <?php
        
        $autoloader = require __DIR__ . '/vendor/autoload.php';
        
        $autoloader->addPsr4('Dreamscape\\ResellerApiSdk\\', __DIR__ . '/libs/DreamscapeResellerApiSdk/src');
        ```

    * use the native PHP's class autoloader:

        ```php
        <?php

        spl_autoload_register(function ($class_name) {
            $lib_namespace = 'Dreamscape\\ResellerApiSdk\\';

            if (strpos($class_name, $lib_namespace) === false) {
                return;
            }

            $class_path = str_replace([ $lib_namespace, '\\' ], [ '', '/' ], $class_name);
            $class_file = __DIR__ . '/libs/DreamscapeResellerApiSdk/src/' . $class_path . '.php';

            if (!file_exists($class_file)) {
                return;
            }

            include_once $class_file;
        });
        ```
   
### First steps

#### Creating the instance of API

To start using the Reseller API SDK, you need to create the instance of the `Dreamscape\ResellerApiSdk\Api` class.
The constructor of this class accepts the instance of HTTP adapter, and the instance of request logger (optional).
Additionally, the HTTP adapter requires an instance of an authenticator and the location of the Dreamscape Reseller REST API.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Http\Request;
use Dreamscape\ResellerApiSdk\Http\Response;
use Dreamscape\ResellerApiSdk\RequestLogger;

// Implementation of request logger.
class MySQLRequestLogger implements RequestLogger
{
    // The class must implement only one method `log()`.
    // This method receives the instances of request and response
    // from which detailed information can be obtained.
    public function log(Request $request, Response $response)
    {
        // Log details about the HTTP request (e.g. to the MySQL database).
    }
}

// Create the instance of authenticator.
$auth = new ApiKey(
    // Reseller API Key. Can be found in Reseller Panel.
    'YourAPIKeyGoesHere'
);
// Create the instance of HTTP adapter.
$http_adapter = new Curl(
    // Instance of used authenticator.
    $auth,
    // Location of Reseller REST API.
    // It can be found in the documentation for Dreamscape Reseller REST API.
    'https://reseller-api.ds.network'
);
// Now we can create the instance of Api.
$api = new Api(
    // Instance of used HTTP adapter.
    $http_adapter,
    // The instance of request logger.
    new MySQLRequestLogger()
);
```

*Note:* Information about HTTP adapters and authenticators you can find in the sections below.

#### Invoking the API call

All the SDK API methods are being grouped by their functions: Domain API methods, Customer API methods, etc.
Each group is accessible via the property of the instance of the `Dreamscape\ResellerApiSdk\Api` class.
See an example below.

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;
use Dreamscape\ResellerApiSdk\Filter;

$api = new Api(
    new Curl(
        new ApiKey('YourAPIKeyGoesHere'),
        'https://reseller-api.ds.network'
    )
);

// Specify additional conditions by using the filter.
$filters = Filter\Domain\GetAll::build();
$filters->page = 2;
$filters->limit = 50;

// Get the list of 50 domains on the 2nd page.
$domains = $api->domains->getAll($filters);
```

The detailed documentation of other SDK API methods for each group is described in the [List of API methods](List_of_api_methods.md) section.

#### HTTP adapters

Reseller API SDK has a built-in HTTP clients and adapters for them that cover all needs of the SDK.

| Adapter class                                   | Description                    |
|-------------------------------------------------|--------------------------------|
| `Dreamscape\ResellerApiSdk\Http\Adapter\Curl`   | HTTP adapter that uses cURL.   |
| `Dreamscape\ResellerApiSdk\Http\Adapter\Stream` | HTTP adapter that uses stream. |

By default, we recommend to use cURL-based HTTP adapter, but it requires cURL extension to be installed.
If there is no such extension on your server, and it's not real to install this, you can use the stream-based HTTP adapter.

Also, you are free to create your own HTTP adapter to use another library to work with HTTP requests.
Fort this you simply need to create a class that extends the `Dreamscape\ResellerApiSdk\Http\Adapter\AbstractAdapter` class and implement its abstract methods.
Take a look at `Dreamscape\ResellerApiSdk\Http\Adapter\Curl` to see how it works.

#### Authenticators

Currently, the Reseller REST API allows authentication via Reseller API Key only. Information about this mechanism of authentication can be found in documentation for Dreamscape Reseller REST API.

This mechanism of authentication is implemented in the `ApiKey` authenticator (the `Dreamscape\ResellerApiSdk\Authenticator\ApiKey` class).

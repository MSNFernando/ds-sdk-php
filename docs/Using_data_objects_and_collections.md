## Using Data-Objects and Collections

Data-objects is a better replacement for arrays that allows you to manipulate data in OOP style.
The main role of data-objects is to store the data of entities according to its described structure.

### Building the data-objects

Each data-object can be created by calling the `build()` static method in the data-object class.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\DataObject;

// Build the instance of data-object.
$register_domain = DataObject\Domain\Register::build();

// Build the instance of data-object from an array.
$register_domain = DataObject\Domain\Register::build([
    'domainName' => 'crazydomains.com',
    'period' => 12,
    'customerId' => 12345678,
    // Specify the items for the property that stores the collection.
    // Collections will be described below.
    'nameServers' => [
        NameServer:build([ 'host' => 'ns1.secureparkme.com' ]),
        NameServer:build([ 'host' => 'ns2.secureparkme.com' ]),
    ],
]);
```

### Manipulations with data-objects

To set the value of a property, you can simply assign a value to it using the assignment operator.
Also, a setter is being defined for each property, and this is the second way to set the property value.
The setter method returns the same instance of the data-object, so it can be used for piping.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\DataObject;

// Build the instance of data-object.
$register_domain = DataObject\Domain\Register::build();

// Set the value of property using the assignment operator.
$register_domain->domainName = 'crazydomains.com.au';
$register_domain->customerId = 123456;

// Set the value of property using the setter method.
$register_domain->setPeriod(12)->setAdminContactId(123456);
```

### Using data-objects with API methods

Most of the API methods accept data-object on input and return data-object or the collection of data-objects.

Example:

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\DataObject;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(
    new Curl(
        new ApiKey('YourAPIKeyGoesHere'),
        'https://reseller-api.ds.network'
    )
);

$register_domain = DataObject\Domain\Register::build()
    ->setDomainName('crazydomains.com')
    ->setCustomerId(12345678)
    ->setPeriod(12);

// Pass the prepared data-object to the API method.
// This method return the instance of another data-object,
// in this case - the instance of registered domain.
$domain = $api->domains->register($register_domain);

// Get the value of the property of the returned data-object.
echo 'Domain ID: ' . $domain->id;
```

The next example shows the case of the collection with data-objects:

```php
<?php

use Dreamscape\ResellerApiSdk\Api;
use Dreamscape\ResellerApiSdk\Authenticator\ApiKey;
use Dreamscape\ResellerApiSdk\Http\Adapter\Curl;

$api = new Api(
    new Curl(
        new ApiKey('YourAPIKeyGoesHere'),
        'https://reseller-api.ds.network'
    )
);

// The next method returns the collection of data-objects.
$domains = $api->domains->getAll();

// Iterate through the collection.
foreach ($domains as $domain) {
    echo 'Domain ID: ' . $domain->id . PHP_EOL;
}
```

### Using collections of data-objects

Collections of data-objects are being representing by the `Dreascape\ResellerApiSdk\DataObject\Collection` class. This class implements `Iterator`, `ArrayAccess` and `Countable` PHP interfaces, so you can:

* iterate through collection via foreach:

    ```php
    <?php
    
    $domains = $api->domains->getAll();
    
    foreach ($domains as $domain) {
        echo 'Domain name: ' . $domain->domainName . PHP_EOL;
    }
    ```

* access to the data-objects by index:

    ```php
    <?php
    
    $domains = $api->domains->getAll();
    // Get the first data-object in collection.
    $domain = $domains[0];
    
    echo 'Domain name: ' . $domain->domainName . PHP_EOL;
    ```

* get the number of data-objects in the collection using the `count()` method:

    ```php
    <?php
    
    $domains = $api->domains->getAll();
    
    echo 'Number of domains: ' . count($domains);
    ```

In addition, other methods are available:

* creating the instance of collection:

    ```php
    <?php
    
    use Dreamscape\ResellerApiSdk\DataObject\Collection;
    use Dreamscape\ResellerApiSdk\DataObject\Domain\NameServer;
    
    // The `build()` method requires the class of data-object.
    $collection = Collection::build(NameServer::class);
    ```

* adding a single item to the collection:

    ```php
    <?php
    
    use Dreamscape\ResellerApiSdk\DataObject\Collection;
    use Dreamscape\ResellerApiSdk\DataObject\Domain\NameServer;
    
    $collection = Collection::build(NameServer::class);
    // Only objects of the class, specified in the `build()` method, can be added.
    $collection->add(NameServer::build([ 'host' => 'ns1.secureparkme.com' ]));
    ```

* adding a multiple items to the collection:

    ```php
    <?php
    
    use Dreamscape\ResellerApiSdk\DataObject\Collection;
    use Dreamscape\ResellerApiSdk\DataObject\Domain\NameServer;
    
    $collection = Collection::build(NameServer::class);
    // Only objects of the class, specified in the `build()` method, can be added.
    $collection->import([
        NameServer::build()->setHost('ns1.secureparkme.com'),
        NameServer::build()->setHost('ns2.secureparkme.com'),
    ]);
    ```

### Pagination details

If the API method supports pagination, the returned collection of data-objects will contain the pagination details.
These details are available via read-only properties of the collection.

| Property    | Description                                                 | Example               |
|-------------|-------------------------------------------------------------|-----------------------|
| totalItems  | Total number of items that matches the conditions.          | $domains->totalItems  |
| totalPages  | Total number of pages of items that matches the conditions. | $domains->totalPages  |
| currentPage | The number of current page.                                 | $domains->currentPage |

Example:

```php
<?php

$domains = $api->domains->getAll();

echo 'Total items: ' . $domains->totalItems . PHP_EOL;
echo 'Total pages: ' . $domains->totalPages . PHP_EOL;
echo 'Current page: ' . $domains->currentPage . PHP_EOL;
```

### Using filters

For some SDK API methods, that returns collection of items, filters can apply.
Filters allow you to set additional conditions for selecting elements or/and limit the number of these elements.
They have the same API as data-objects because they extend the same base class.

For what filter is being used you can see in the documentation for the specific SDK API method.

### Predefined values

To avoid the typos the predefined values have been added for some static values.
See the constants in the `Dreamscape\ResellerApiSdk\PredefinedValue` namespace.

### Representing data-objects as arrays

Data-objects and collections of data-objects can be represented as an array.
For this purpose the `toArray()` method can be used.
See an example for a single data-object:

```php
<?php

// Get the single data-object.
$domain = $api->domains->getDetails(12345678);
// Represent data-object as an array.
$domain_array = $domain->toArray();
/*
    [
        'id' => 123456,
        'domainName' => 'crazydomains.com',
        'customerId' => 12345678,
        'authKey' => '#UIGTF&8392iofv9!',
        ...
    ]
*/
```

See an example for the collection of data-objects:

```php
<?php

// Get the collection of data-objects.
$domains = $api->domains->getAll();

// Represent the collection of data-object as an array.
$domains_array = $domains->toArray();
/*
[
	[
		'id' => 123456,
		'domainName' => 'crazydomains.com',
		'customerId' => 12345678,
		'authKey' => '#UIGTF&8392iofv9!',
		...
	],
]
*/
```

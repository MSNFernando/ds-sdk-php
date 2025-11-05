## Invoice API

* [getAll()](#getall)

### getAll()<a name="getall"></a>

#### Description

Returns the list of invoices.

#### Signature

getAll([Filter\Finance\Invoice\GetAll](../Filters/Finance/Invoice/GetAll.md) \$filters = null): [DataObject\Finance\Invoice[]](../Data_objects/Finance/Invoice.md) 

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
use DateTime;

$api = new Api(new Curl(new ApiKey('YourAPIKeyGoesHere'), 'https://reseller-api.sandbox.ds.network'));

$filters = Filter\Finance\Invoice\GetAll::build();

$filters->customerId = 123456;
$filters->limit = 10;
$filters->page = 1;

try {
    $invoices = $api->finances->invoices->getAll($filters);

    foreach ($invoices as $invoice) {
        echo 'ID: ' . $invoice->id . PHP_EOL;
        echo 'Customer ID: ' . $invoice->customerId . PHP_EOL;
        echo 'Amount: ' . $invoice->totalAmount . PHP_EOL;
        echo 'Date: ' . $invoice->orderDate->format(DateTime::ATOM) . PHP_EOL;

        foreach ($invoice->orders as $order) {
            echo 'Product: ' . $order->productName . PHP_EOL;
            echo 'Price: ' . $order->price . PHP_EOL;
        }
    }

    echo 'Total items: ' . $invoices->totalItems . PHP_EOL;
    echo 'Total pages: ' . $invoices->totalPages . PHP_EOL;
    echo 'Current page: ' . $invoices->currentPage . PHP_EOL;
} catch (Exception\BadRequestException $e) {
    // Handle the errors in $e->getErrors().
}
```


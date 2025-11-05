## Filter\Finance\Invoice\GetAll

#### Description

Filters for the `$api->finances->invoices->getAll()` method.

#### Properties

* int $page
* int $limit
* DateTime $fromDate
* DateTime $toDate
* int $customerId

#### Methods

* setPage(int $page): self
* setLimit(int $limit): self
* setFromDate(DateTime|string $from_date): self
* setToDate(DateTime|string $to_date): self
* setCustomerId(int $customer_id): self

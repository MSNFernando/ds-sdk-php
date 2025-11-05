## Filter\Domain\GetAll

#### Description

Filters for the `$api->domains->getAll()` method.

#### Properties

* int $page
* int $limit
* string $domainName
* int $customerId
* int $adminContactId
* int $billingContactId
* int $techContactId
* int $statusId
* string[] $tlds

#### Methods

* setPage(int $page): self
* setLimit(int $limit): self
* setDomainName(string $domain_name): self
* setCustomerId(int $customer_id): self
* setAdminContactId(int $admin_contact_id): self
* setBillingContactId(int $billing_contact_id): self
* setTechContactId(int $tech_contact_id): self
* setStatusId(int $status_id): self
* setTlds(array $tlds): self

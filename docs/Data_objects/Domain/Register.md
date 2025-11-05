## DataObject\Domain\Register

#### Properties

* string $domainName
* int $period
* int $customerId
* int $registrantId
* int $adminContactId
* int $billingContactId
* int $techContactId
* [DataObject\Domain\NameServer\Create[]](../Domain/NameServer/Create.md) $nameServers
* array $eligibility
* bool $privacy
* bool $confirmPremiumOrder

#### Methods

* setDomainName(string $domain_name): self
* setCustomerId(int $customer_id): self
* setRegistrantId(int $registrant_id): self
* setPeriod(int $period): self
* setAdminContactId(int $admin_contact_id): self
* setBillingContactId(int $billing_contact_id): self
* setTechContactId(int $tech_contact_id): self
* setNameServers(Collection $name_servers): self
* setEligibility(array $eligibility): self
* setPrivacy(bool $privacy): self
* setConfirmPremiumOrder(bool $confirm_premium_order): self

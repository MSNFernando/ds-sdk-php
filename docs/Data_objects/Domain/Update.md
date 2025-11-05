## DataObject\Domain\Update

#### Properties

* int $adminContactId
* int $billingContactId
* int $techContactId
* [DataObject\Domain\NameServer\Create[]](../Domain/NameServer/Create.md) $nameServers
* bool $privacy
* bool $isLocked

#### Methods

* setAdminContactId(int $admin_contact_id): self
* setBillingContactId(int $billing_contact_id): self
* setTechContactId(int $tech_contact_id): self
* setNameServers(Collection $name_servers): self
* setPrivacy(bool $privacy): self
* setIsLocked(bool $is_locked): self

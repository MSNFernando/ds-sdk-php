<?php

namespace Dreamscape\ResellerApiSdk\Filter\Domain;

use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\Filter\Pagination;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * Filters for the `$api->domains->getAll()` method.
 *
 * @property string $domainName
 * @property int $customerId
 * @property int $adminContactId
 * @property int $billingContactId
 * @property int $techContactId
 * @property int $statusId
 * @property string[] $tlds
 *
 * @method $this setDomainName(string $domain_name)
 * @method $this setCustomerId(int $customer_id)
 * @method $this setAdminContactId(int $admin_contact_id)
 * @method $this setBillingContactId(int $billing_contact_id)
 * @method $this setTechContactId(int $tech_contact_id)
 * @method $this setStatusId(int $status_id)
 * @method $this setTlds(array $tlds)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class GetAll extends Pagination
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return parent::describeStructure()
            ->addProperty(
                Structure\Property::build('domainName', 'domain_name')
                    ->type(Structure\DataType::STRING)
                    ->rules(RuleSet::build()->addRule(Rule::notEmpty()))
            )
            ->addProperty(
                Structure\Property::build('customerId', 'customer_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('adminContactId', 'admin_contact_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('billingContactId', 'billing_contact_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('techContactId', 'tech_contact_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('statusId', 'status_id')
                    ->type(Structure\DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Structure\Property::build('tlds')
                    ->type(Structure\DataType::STRING_ARRAY)
                    ->rules(RuleSet::build()->addRule(Rule::notEmptyArray()))
            );
    }
}

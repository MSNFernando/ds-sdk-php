<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;
use Dreamscape\ResellerApiSdk\Validation\Rule;
use Dreamscape\ResellerApiSdk\Validation\RuleSet;

/**
 * @property int $adminContactId
 * @property int $billingContactId
 * @property int $techContactId
 * @property NameServer\Create[]|Collection $nameServers
 * @property bool $privacy
 * @property bool $isLocked
 *
 * @method $this setAdminContactId(int $admin_contact_id)
 * @method $this setBillingContactId(int $billing_contact_id)
 * @method $this setTechContactId(int $tech_contact_id)
 * @method $this setNameServers(Collection $name_servers)
 * @method $this setPrivacy(bool $privacy)
 * @method $this setIsLocked(bool $is_locked)
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Update extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(
                Property::build('adminContactId', 'admin_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Property::build('billingContactId', 'billing_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(
                Property::build('techContactId', 'tech_contact_id')
                    ->type(DataType::INTEGER)
                    ->rules(RuleSet::build()->addRule(Rule::numberPositive()))
            )
            ->addProperty(Property::build('nameServers', 'name_servers')
                ->collectionType(NameServer\Create::class))
            ->addProperty(Property::build('privacy')
                ->type(DataType::BOOL))
            ->addProperty(Property::build('isLocked', 'is_locked')
                ->type(DataType::BOOL));
    }
}

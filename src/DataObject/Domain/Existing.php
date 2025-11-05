<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Domain;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;
use Dreamscape\ResellerApiSdk\DataObject\Structure\Property;

/**
 * @property int $id
 * @property string $domainName
 * @property string $authKey
 * @property int $statusId
 * @property int $period
 * @property DateTime|null $startDate
 * @property DateTime|null $expiryDate
 * @property int $customerId
 * @property int $registrantId
 * @property int $adminContactId
 * @property int $billingContactId
 * @property int $techContactId
 * @property NameServer\Existing[]|Collection $nameServers
 * @property array|null $eligibility
 * @property bool $privacy
 * @property bool $isLocked
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Existing extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Property::build('id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('domainName', 'domain_name')
                ->type(DataType::STRING))
            ->addProperty(Property::build('authKey', 'auth_key')
                ->type(DataType::STRING))
            ->addProperty(Property::build('statusId', 'status_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('period')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('startDate', 'start_date')
                ->type(DataType::DATETIME))
            ->addProperty(Property::build('expiryDate', 'expiry_date')
                ->type(DataType::DATETIME))
            ->addProperty(Property::build('customerId', 'customer_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('registrantId', 'registrant_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('adminContactId', 'admin_contact_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('billingContactId', 'billing_contact_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('techContactId', 'tech_contact_id')
                ->type(DataType::INTEGER))
            ->addProperty(Property::build('nameServers', 'name_servers')
                ->collectionType(NameServer\Existing::class))
            ->addProperty(Property::build('eligibility', 'eligibility_data')
                ->type(DataType::ARRAY))
            ->addProperty(Property::build('privacy')
                ->type(DataType::BOOL))
            ->addProperty(Property::build('isLocked', 'is_locked')
                ->type(DataType::BOOL));
    }
}

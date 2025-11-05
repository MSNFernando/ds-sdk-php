<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Base;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read int $id
 * @property-read int $customerId
 * @property-read int $statusId
 * @property-read string $name
 * @property-read int $planId
 * @property-read int $period
 * @property-read DateTime|null $startDate
 * @property-read DateTime|null $expiryDate
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
abstract class AbstractExisting extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('customerId', 'customer_id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('statusId', 'status_id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('domainName', 'domain_name')
                ->type(DataType::STRING))
            ->addProperty(Structure\Property::build('name')
                ->type(DataType::STRING))
            ->addProperty(Structure\Property::build('planId', 'plan_id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('period')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('startDate', 'start_date')
                ->type(DataType::DATETIME))
            ->addProperty(Structure\Property::build('expiryDate', 'expiry_date')
                ->type(DataType::DATETIME));
    }
}

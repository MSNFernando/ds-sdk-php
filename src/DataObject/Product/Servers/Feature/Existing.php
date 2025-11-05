<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Servers\Feature;

use DateTime;
use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read int $id
 * @property-read string $type
 * @property-read string $value
 * @property-read int $period
 * @property-read int $statusId
 * @property-read DateTime|null $startDate
 * @property-read DateTime|null $expiryDate
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
            ->addProperty(Structure\Property::build('id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('type')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('value')
                ->type(Structure\DataType::STRING))
            ->addProperty(Structure\Property::build('period')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('statusId', 'status_id')
                ->type(Structure\DataType::INTEGER))
            ->addProperty(Structure\Property::build('startDate', 'start_date')
                ->type(DataType::DATETIME))
            ->addProperty(Structure\Property::build('expiryDate', 'expiry_date')
                ->type(DataType::DATETIME));
    }
}

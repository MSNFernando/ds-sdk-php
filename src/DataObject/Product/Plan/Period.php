<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read int $period
 * @property-read bool $isFreeTrial
 * @property-read bool $isRenewable
 * @property-read bool $expires
 * @property-read PeriodPrice $price
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Period extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('period')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('isFreeTrial', 'is_free_trial')
                ->type(DataType::BOOL))
            ->addProperty(Structure\Property::build('isRenewable', 'is_renewable')
                ->type(DataType::BOOL))
            ->addProperty(Structure\Property::build('expires')
                ->type(DataType::BOOL))
            ->addProperty(Structure\Property::build('price')
                ->dataObjectType(PeriodPrice::class));
    }
}

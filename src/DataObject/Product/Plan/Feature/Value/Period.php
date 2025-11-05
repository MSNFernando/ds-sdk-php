<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan\Feature\Value;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read int $period
 * @property-read Period\Price $price
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
            ->addProperty(Structure\Property::build('price')
                ->dataObjectType(Period\Price::class));
    }
}

<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan\Feature\Value\Period;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Structure;

/**
 * @property-read float $wholesale
 * @property-read float $register
 * @property-read float $renew
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Price extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('wholesale')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('register')
                ->type(Structure\DataType::FLOAT))
            ->addProperty(Structure\Property::build('renew')
                ->type(Structure\DataType::FLOAT));
    }
}

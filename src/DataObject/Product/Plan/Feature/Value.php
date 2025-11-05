<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan\Feature;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read string $value
 * @property-read Value\Period[]|Collection $periods
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Value extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('value')
                ->type(DataType::STRING))
            ->addProperty(Structure\Property::build('periods')
                ->collectionType(Value\Period::class));
    }
}

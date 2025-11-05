<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read int $typeId
 * @property-read Period[]|Collection $periods
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
            ->addProperty(Structure\Property::build('name', 'name')
                ->type(DataType::STRING))
            ->addProperty(Structure\Property::build('typeId', 'type_id')
                ->type(DataType::INTEGER))
            ->addProperty(Structure\Property::build('periods', 'periods')
                ->collectionType(Period::class));
    }
}

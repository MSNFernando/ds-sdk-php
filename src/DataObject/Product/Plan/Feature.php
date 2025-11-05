<?php

namespace Dreamscape\ResellerApiSdk\DataObject\Product\Plan;

use Dreamscape\ResellerApiSdk\DataObject\AbstractDataObject;
use Dreamscape\ResellerApiSdk\DataObject\Collection;
use Dreamscape\ResellerApiSdk\DataObject\Structure;
use Dreamscape\ResellerApiSdk\DataObject\Structure\DataType;

/**
 * @property-read string $type
 * @property-read Feature\Value[]|Collection $values
 *
 * @copyright Dreamscape Networks International Pte Ltd https://www.dreamscapenetworks.com
 */
class Feature extends AbstractDataObject
{
    /**
     * @inheritDoc
     */
    protected static function describeStructure(): Structure
    {
        return Structure::build()
            ->addProperty(Structure\Property::build('type')
                ->type(DataType::STRING))
            ->addProperty(Structure\Property::build('values')
                ->collectionType(Feature\Value::class));
    }
}
